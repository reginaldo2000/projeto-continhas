<?php

namespace Source\Controller;

use DateTime;
use Source\Entity\Conta;
use Source\Enum\CategoriaEnum;
use Source\Util\EntityManagerFactory;

class ContaController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function contas(): void
    {
        $categoria = filter_input(INPUT_GET, "categoria") ?? "";
        $contasPorCategoria = $this->listaContas();

        echo $this->view->render("contas", [
            "categorias" => CategoriaEnum::list(),
            "contas" => $this->list($categoria),
            "contasCategoria" => $contasPorCategoria,
            "categoriaSelecionada" => $categoria
        ]);
    }

    public function salvar(array $data): void
    {
        $categoria = $data["categoria"] ?? "";
        $numParcelas = $data["num_parcelas"];

        if ($categoria == CategoriaEnum::COMPRA_PARCELADA) {
            for ($i = 0; $i < $numParcelas; $i++) {
                $dataConta = new DateTime($data["data"]);
                $dataConta->setDate(date("Y"), (date("m")+$i), date("d"));
                $this->saveConta($data, $dataConta, $i+1, $numParcelas);
            }
        } else {
            $this->saveConta($data, new DateTime($data["data"]));
        }

        setMessage("Conta cadastrada com sucesso!");
        redirect("/contas");
    }

    public function atualizar(array $data): void
    {
        $em = EntityManagerFactory::getEntityManager();

        $id = filter_var($data["id"], FILTER_VALIDATE_INT) ?: 0;

        $conta = $em->getRepository(Conta::class)->find($id);
        if (empty($conta)) {
            redirect("/oops/400");
        }

        $conta->setDescricao($data["descricao"] ?? "");
        $conta->setCategoria($data["categoria"] ?? "");
        $conta->setValor($data["valor"] ?? "");
        $conta->setData(new DateTime($data["data"]));

        if (!$conta->isValid()) {
            setMessage("Preencha os campos corretamente!", "alert-danger");
            redirect("/contas");
        }

        $em->flush();

        setMessage("Conta atualizada com sucesso!");
        redirect("/contas");
    }

    public function get(array $data): void
    {
        $em = EntityManagerFactory::getEntityManager();

        $id = filter_var($data["id"], FILTER_VALIDATE_INT) ?: 0;

        $conta = $em->getRepository(Conta::class)->find($id);
        if (empty($conta)) {
            $this->responseJson(true, "Nenhuma conta encontrada com o ID informado!");
            return;
        }
        $this->responseJson(false, "", $conta->toArray());
    }

    public function excluir(array $data): void
    {
        $em = EntityManagerFactory::getEntityManager();

        $id = filter_var($data["id"], FILTER_VALIDATE_INT) ?: 0;

        $conta = $em->getRepository(Conta::class)->find($id);
        if (empty($conta)) {
            redirect("/oops/400");
        }

        $em->remove($conta);
        $em->flush();

        redirect("/contas");
    }

    private function list(string $categoria): array
    {
        $em = EntityManagerFactory::getEntityManager();

        $restricao = [];
        if ($categoria != "") {
            $restricao["categoria"] = $categoria;
        }
        return $em->getRepository(Conta::class)->findBy($restricao, [
            "id" => "desc"
        ]);
    }

    private function listaContas(): array
    {
        $contasPorCategoria = [];
        foreach (CategoriaEnum::list() as $cat) {
            $list = $this->listContasDoMesByCategoria($cat);
            $dados = [
                "nome" => $cat,
                "tamanho" => count($list) + 1,
                "totalCategoria" => $this->somaTotalCategoria($list),
                "dados" => $list,
                "valorTotal" => $this->valorTotalContas()
            ];
            if (count($list) != 0) {
                array_push($contasPorCategoria, (object) $dados);
            }
        }
        return $contasPorCategoria;
    }

    private function listContasDoMesByCategoria(string $categoria): array
    {
        $em = EntityManagerFactory::getEntityManager();

        $dataInicial = new DateTime(date("Y-m-d"));
        $dataInicial = $dataInicial->setDate(date("Y"), date("m"), 1);

        $dataFinal = new DateTime();
        $dataFinal = $dataFinal->setDate(date("Y"), date("m"), date("t"));

        $query = $em->getRepository(Conta::class)->createQueryBuilder("c")
            ->where("c.categoria = :categoria AND (c.data BETWEEN :dataI AND :dataF OR c.categoria = :cat)")
            ->setParameters([
                "categoria" => $categoria,
                "dataI" => $dataInicial,
                "dataF" => $dataFinal,
                "cat" => CategoriaEnum::GASTO_FIXO
            ])->getQuery();

        return $query->getResult();
    }

    private function somaTotalCategoria(array $list): float
    {
        $valor = 0;
        foreach ($list as $conta) {
            $valor += $conta->getValor();
        }
        return $valor;
    }

    private function valorTotalContas(): float
    {
        $em = EntityManagerFactory::getEntityManager();

        $dataInicial = new DateTime(date("Y-m-d"));
        $dataInicial = $dataInicial->setDate(date("Y"), date("m"), -1);

        $dataFinal = new DateTime();
        $dataFinal = $dataFinal->setDate(date("Y"), date("m"), date("t"));

        $query = $em->getRepository(Conta::class)->createQueryBuilder("c")
            ->select("SUM(c.valor) as valor")
            ->where("(c.data BETWEEN :dataI AND :dataF) OR c.categoria = :cat")
            ->setParameter("dataI", $dataInicial)
            ->setParameter("dataF", $dataFinal)
            ->setParameter("cat", CategoriaEnum::GASTO_FIXO)
            ->getQuery();

        $valorTotal = $query->getOneOrNullResult()["valor"];

        return $valorTotal;
    }

    private function saveConta(array $data, DateTime $dataConta, int $numParcela = 1, int $totalParcelas = 1): void
    {
        $em = EntityManagerFactory::getEntityManager();

        $conta = new Conta();
        $conta->setCategoria($data["categoria"] ?? "");
        $conta->setDescricao($data["descricao"] ?? "");
        $descricao = ($conta->getCategoria() == CategoriaEnum::COMPRA_PARCELADA ? $conta->getDescricao()." ({$numParcela}/{$totalParcelas})" : $conta->getDescricao());
        $conta->setDescricao($descricao);
        $conta->setValor(str_replace(",", ".", $data["valor"] ?? 0));
        $conta->setData($dataConta);
        $valor = $conta->getValor() / $totalParcelas;
        $conta->setValor($valor);

        if (!$conta->isValid()) {
            setMessage("Preencha os campos corretamente!", "alert-danger");
            redirect("/contas");
        }

        $em->persist($conta);
        $em->flush();
    }
}
