console.log(window.tempArray);

var consoArray = window.tempArray;
var gammeArray = [];



//gamme

consoArray.forEach((product, index) => {
    if (gammeArray.indexOf(product.gamme.name) === -1) gammeArray.push(product.gamme.name)
})

gammeArray.forEach((gamme, index) => {
    var select = document.getElementById("gamme");
    var option = document.createElement("option");
    option.text = gamme;
    select.add(option, select[index + 1]);
})


//produit

var gamme = document.getElementById("gamme");
var prod = document.getElementById("produit");
var materiaux = document.getElementById("materiaux");
var surface = document.getElementById("surface");
var result = document.querySelector(".conso-result");
var btn_product=document.querySelector(".btn-product");

var linkArray=[];


gamme.addEventListener('change', (e) => {

    while (prod.options.length > 1) {
        prod.remove(prod.options.length - 1);
    }

    while (materiaux.options.length > 1) {
        materiaux.remove(materiaux.options.length - 1);
    }

    result.innerHTML = "";

linkArray=[];

    consoArray.forEach((product, index) => {
        if (product.gamme.name == gamme.options[gamme.selectedIndex].text) {
            var select = document.getElementById("produit");
            var option = document.createElement("option");
            option.text = product.name;
            option.value = index;
            select.add(option, select[index + 1]);
            linkArray.push(product.lien_vers_fiche_produit)
        }
    });

    document.querySelector('.product-block').classList.add('active')
})


prod.addEventListener('change', (e) => {

    var nProd = prod.options[prod.selectedIndex].value;

    while (materiaux.options.length > 1) {
        materiaux.remove(materiaux.options.length - 1);
    }

    consoArray[nProd].materiaux.forEach((mat, index) => {
        var select = document.getElementById("materiaux");
        var option = document.createElement("option");
        option.text = mat.name;
        option.value = mat.consommation;
        select.add(option, select[index + 1]);
    })

    document.querySelector('.mat-block').classList.add('active')
    btn_product.setAttribute('href',linkArray[prod.selectedIndex-1]);

})



materiaux.addEventListener('change', (e) => {
    document.querySelector('.surface-block').classList.add('active')
    get_result();

});



surface.addEventListener('change', (e) => {
    get_result();
});

surface.addEventListener('input', (e) => {
    get_result();
});



function get_result() {
    if (surface.value > 0 && parseInt(materiaux.options[materiaux.selectedIndex].value) > 0) {
        var calcul = Math.round(parseInt(surface.value) / parseInt(materiaux.options[materiaux.selectedIndex].value) * 10) / 10;
        var unit = calcul > 1 ? " litres" : " litre";
        result.innerHTML = calcul + unit;
    }
    else {
        result.innerHTML = "";
    }

}
