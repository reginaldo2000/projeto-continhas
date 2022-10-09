$(document).ready(() => {
    const table = $("table[pagination='true']");
    let rowsPage = table.attr("rows");
    let tableId = table.attr("target");
    let maxRows = table.attr("max-rows");
    let cont = 1;

    if (maxRows > 0) {
        const rows = document.querySelectorAll(`${tableId} tr`);
        rows.forEach(row => {
            row.setAttribute("hidden", true);
            if (cont <= rowsPage) {
                row.removeAttribute("hidden");
            }
            cont++;
        });
    }
    pagination(1);
});

function mudarPagina(element, pagina) {
    const table = $("table[pagination='true']");
    let rowsPage = table.attr("rows");
    let tableId = table.attr("target");

    let cont = 1;
    let start = (pagina - 1) * rowsPage;
    let limit = (pagina * rowsPage);

    const rows = document.querySelectorAll(`${tableId} tr`);
    rows.forEach(row => {
        row.setAttribute("hidden", true);
        if (cont > start && cont <= limit) {
            row.removeAttribute("hidden");
        }
        cont++;
    });

    pagination(pagina);

    $(".pagination li").removeClass("active");
    $(`#page${pagina} `).addClass("active");
}


function pagination(pagina) {
    const table = $("table[pagination='true']");
    let maxRows = table.attr("max-rows");
    let rows = table.attr("rows");
    let maxPages = maxRows % rows == 0 ? maxRows / rows : parseInt(maxRows / rows) + 1;
    let start = pagina >= 3 ? pagina - 2 : 1;
    let end = pagina >= 3 ? pagina + 2 : 5;

    if (maxRows > 0) {
        let string = `<li class="page-item"><a class="page-link" href="#" aria-label="Previous" onclick="mudarPagina(this, ${((pagina - 1 == 0) ? 1 : pagina - 1)});"><span aria-hidden="true">&laquo;</span></a></li>`;
        for (let i = start; i <= end && i <= maxPages; i++) {
            string += `<li id="page${i}" class="page page-item ${(i == 1 ? "active" : "")}"><a class="page-link" href="#" onclick="mudarPagina(this, ${i});">${i}</a></li>`;
        }
        string += `<li class="page-item"><a class="page-link" href="#" aria-label="Next" onclick="mudarPagina(this, ${((pagina + 1 > maxPages) ? parseInt(maxPages) : pagina + 1)});"><span aria-hidden="true">&raquo;</span></a></li>`;
        $(".pagination").html(string);
    }
}