
let btn_var = document.getElementsByClassName('del_btn');
let type_var = document.getElementsByClassName('data_source');
let edit_var = document.getElementsByClassName('edit_btn');
let count_var=document.getElementById('count_var').value;



window.onload = (event) => {

    for (let i = 0; i <= count_var-1; i++) {
        if (type_var[i].value == 1) {
            btn_var[i].setAttribute("disabled", "");
        }

        if (type_var[i].value == 2) {
            edit_var[i].setAttribute("disabled", "");
        }
    }

};

 
