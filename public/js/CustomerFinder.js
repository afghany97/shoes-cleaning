
function search(){

    mobileValue = document.getElementById("mobile").value;

    if(mobileValue != "")
    {
        $.ajax({
            url: "/customers/find/" + mobileValue,
            type: 'GET',
            success: function(response) {
                fillData(response);
            },
            error: function() {
                alert("Customer Not Found");
            }
        });
    }
    else{
        alert('enter mobile number first ..!');
    }
}

function fillData(data){

    document.getElementById("name").value = data.name;
    document.getElementById("name").className += ' alert-success';

    document.getElementById("address").value = data.address;
    document.getElementById("address").className += ' alert-success';

}