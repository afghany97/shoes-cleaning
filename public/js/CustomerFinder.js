$("#mobile").keyup(search);

let mobile = document.getElementById("mobile");

function search(){

    $.ajax({
        url: "/customers/find/" + mobile.value,
        type: 'GET',
        success: function(response) {
            fillData(response);
        },
        error: function() {
            clearData();
        }
    });
}

function fillData(data){

    document.getElementById("name").value = data.name;
    document.getElementById("name").className += ' alert-success';

    document.getElementById("address").value = data.address;
    document.getElementById("address").className += ' alert-success';
}

function clearData() {
    document.getElementById("name").value = "";
    document.getElementById("name").className = 'form-control';

    document.getElementById("address").value = "";
    document.getElementById("address").className = 'form-control';
}