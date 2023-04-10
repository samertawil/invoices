
let grams = document.getElementById('grams');

let gram_price = document.getElementById('gram_price');

// let total = document.getElementById('total');

let puffer= document.getElementById('puffer');

let sum_input = document.getElementById('sum_input');


// grams.onkeyup = function () {

//     total.value = gram_price.value * grams.value;
//     // sum_input.value= total.value
 
  
// };

// gram_price.onkeyup = function () {

//     total.value = gram_price.value * grams.value;
//     // sum_input.value= total.value

// };



let grams_row = document.getElementsByClassName('gram_row');
let gram_price_row = document.getElementsByClassName('gram_price_row');
let total_row = document.getElementsByClassName('total_row');

let inum_var = document.getElementById('inum');
let countitem = document.getElementsByClassName('countitem');

let cou_var = 0;

function DoCount() {
    cou_var = cou_var + 1;
    inum_var.value = cou_var;

}

function minCount() {
    cou_var = cou_var - 1;
    inum_var.value = cou_var;
    let count_var1 = (inum_var.value);


}


function calc_rows() {


    let count_var = 2;
    //(inum_var.value) - 1;
    for (let i = 0; i <= total_row.length; i++) {
        // console.log(count_var);
          total_row[i].value = grams_row[i].value * gram_price_row[i].value;

    }

}


function SortFun() {
    let count_var1 = (inum_var.value);
    for (let i = 0; i <= count_var1 - 1; i++) {
        countitem[i].value = i + 2;
    }

}
 


function Calculate() {
    let sum_input_var = document.getElementById('sum_input');
    let total_row1 = document.getElementsByClassName('total_row');
    let total1 = document.getElementById('total');
    let sum = 0;

    for (let y = 0; y <= total_row1.length; y++) {
            
        sum += parseInt(total_row1[y].value)  ;  
        sum_input_var.value = sum+ (gram_price.value * grams.value) ;
        
       

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


