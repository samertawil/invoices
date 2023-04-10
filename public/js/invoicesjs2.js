
let grams_row = document.getElementsByClassName('gram_row'); // الوزن
let gram_price_row = document.getElementsByClassName('gram_price_row'); // سعر الجرام
let total_row = document.getElementsByClassName('total_row'); // اجمالي الصنف

let sum_input_var = document.getElementById('sum_input');  // اجمالي الفاتورة
let count_item_row = document.getElementsByClassName('count_item_row');  // ترقيم الصنف



function calc_rows() {

    for (let i = 0; i <= total_row.length - 1; i++) {   // عمليات ضرب الوزن بسعر الجرام 

        total_row[i].value = (grams_row[i].value * gram_price_row[i].value).toFixed(2);

    }
    let sum = 0;        // احتساب مجموع بنود اصناف الفاتورة

    for (let y = 0; y <= total_row.length - 1; y++) {

        sum += parseFloat(total_row[y].value);

        sum_input_var.value = sum;
    }
}



function remove_fn(e) {

    e.parentNode.parentNode.parentNode.parentNode.remove(); // كود حذف عنصر الصنف


    let sum = 0; // اعادة احتساب المجموع النهائي

    for (let y = 0; y <= total_row.length - 1; y++) {

        sum += parseFloat(total_row[y].value);
        sum_input_var.value = sum;
    }


    for (let i = 0; i <= total_row.length - 1; i++) {  // اعادة ترقيم مسلسل الصنف لسد الgap

        count_item_row[i].value = i + 2;

    }

}

function resort_add() {

    let count_item_row1 = document.getElementsByClassName('count_item_row');  // ترقيم الصنف
    for (let i = 0; i <= (b - 2); i++) {  // اعادة ترقيم مسلسل الصنف لسد الgap

        count_item_row1[i].value = i + 2;

    }

}






//------------------ add name and phone number to add to contacts table (not used ) copy input item to anther input item

let name1_var = document.getElementById('name1_id');
let name2_var = document.getElementById('name2_id');

let phone1_var = document.getElementById('phone1_id');
let phone2_var = document.getElementById('phone2_id');

function getname() {

    name2_var.value = name1_id.value;
    phone2_var.value = phone1_id.value;
}


// --------------------------------------------


