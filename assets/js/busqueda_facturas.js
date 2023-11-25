function buscar_facturas() {
    var input=document.getElementById("search-factura");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("tabla_facturas");
    var tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
       var td = tr[i].getElementsByTagName("td")[1];
       if (td) {
        var txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        
        }else{
            tr[i].style.display = "none";
        
        }
       }
    }
}