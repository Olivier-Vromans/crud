window.addEventListener("DOMContentLoaded", function(){
    console.log("Loaded")
    $('#appointments tbody').on('click', '.btnedit', function (e) {

        let table = $('#appointments').DataTable();
        let tr = $(this).closest('tr');

        // If its .child tr then get the parent row
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev('tr.parent');
        }

        // Get the data from the row
        let data = table.row( tr ).data();
        let textvalues = displayData(e);


        let firstname = $("input[name*='firstname']");
        let lastname = $("input[name*='lastname']");
        let email = $("input[name*='email']");
        let phone = $("input[name*='phone']");
        let adress = $("input[name*='adress']");
        let zipcode = $("input[name*='zipcode']");
        let city = $("input[name*='city']");
        let state = $("input[name*='state']");
        let products = $("input[name*='products']");
        let date = $("input[name*='date']");
        let time = $("input[name*='time']");

        console.log(data);
        // Output data from console to form boxes
        firstname.val(data[1]);
        lastname.val(data[2]);
        email.val(data[3]);
        phone.val(data[4]);
        adress.val(data[5]);
        zipcode.val(data[6]);
        city.val(data[7]);
        state.val(data[8]);
        products.val(data[9]);
        date.val(data[10]);
        time.val(data[11]);
    });

    // loading Datatables in the page when turned of I
    // can access the data with my own website
    $('#appointments').DataTable({
        "pageLength": 10,
        "responsive": true,
        "autowidth": true
    });
})

function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for(const value of td){
        if(value.dataset.id == e.target.dataset.id){
            textvalues[id++] = value.textContent;
        }
    }
    console.log(textvalues);
    return textvalues;
}

