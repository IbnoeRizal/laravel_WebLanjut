document.addEventListener('DOMContentLoaded', function() {
const Element = Object.freeze({
    form :          document.getElementById('mainform123'),
    buttonLoad :    document.getElementById('load-btn'),
    buttonInsert:   document.getElementById('Insert-btn'),
    buttonUpdate:   document.getElementById('update-btn'),
    buttonDelete:   document.getElementById('delete-btn'),
});

if(Element.form === null) {
    console.error("Form element not found");
    return;
}

Element.buttonLoad.addEventListener('click', function() {
   handleFetchView(Routing.pilihan,{fungsi:() =>{

        clickButton(Routing.products.index,'Product');
        clickButton(Routing.transactions.index,'Transaction');
        clickButton(Routing.categories.index,'Category');

   }});
});

Element.buttonInsert.addEventListener('click', function() {
    handleFetchView(Routing.pilihan,{fungsi:() =>{

        clickButton(Routing.products.create,'Product');
        clickButton(Routing.transactions.create,'Transaction');
        clickButton(Routing.categories.create,'Category');

    }});
});

Element.buttonUpdate.addEventListener('click',function(){
    handleFetchView(Routing.pilihan,{fungsi:() => {

        clickButtonUpdateDelete(Routing.products.edit,'Product','Pilih',Routing.products.show,'Hapus');
        clickButtonUpdateDelete(Routing.transactions.edit,'Transaction','Pilih',Routing.transactions.show,'Hapus');
        clickButtonUpdateDelete(Routing.categories.edit,'Category','Pilih',Routing.categories.show,'Hapus');

    }})
});

Element.buttonDelete.addEventListener('click',function(){
    handleFetchView(Routing.pilihan,{fungsi:() => {

        clickButtonUpdateDelete(Routing.products.edit,'Product','Pilih',Routing.products.show,'Hapus');
        clickButtonUpdateDelete(Routing.transactions.edit,'Transaction','Pilih',Routing.transactions.show,'Hapus');
        clickButtonUpdateDelete(Routing.categories.edit,'Category','Pilih',Routing.categories.show,'Hapus');

    }})
});



function handleFetchView(url,{fungsi = null} = {}){
    fetch(url)
    .then(response => response.text())
    .then(html => {
        Element.form.firstChild?.remove();
        Element.form.appendChild(new DOMParser().parseFromString(html,'text/html').body.firstElementChild);
    })
    .then(()=>{
        if(fungsi && typeof fungsi === 'function') fungsi();
    })
    .catch(error => console.error('Error:', error));
}

//untuk id
function clickButton($route,...$idButton){
    document.getElementById($idButton[0]).addEventListener('click', ()=>{
        handleFetchView($route,{fungsi:()=>{
            if($idButton[1])
                document.getElementById($idButton[1]).addEventListener('click',()=> {Element.form.firstChild.remove()});
        }})
    });
}

//untuk class
function clickButtonUpdateDelete($route,$idButton1,$classBtnUpdate,$routeshow,$classBtndelete){
    document.getElementById($idButton1).addEventListener('click', ()=>{
        handleFetchView($route,{fungsi:()=>{

            //for edit
            Array.from(document.getElementsByClassName($classBtnUpdate)).forEach(element => {
               element.addEventListener('click',()=> {

                   $url = $routeshow.replace('__ID__',element.value);
                    handleFetchView($url,{fungsi:
                        ()=>{
                            document.getElementById('Submit',()=>{
                                Element.form.firstChild?.remove();
                            });
                        }
                    })
               })
            });

            //for delete
            Array.from(document.getElementsByClassName($classBtndelete)).forEach(element => {
                element.addEventListener('click',()=> {Element.form.firstChild.remove()})
            });
        }})
    });
}


});

//untuk transaksi create
function onProductSelectChange() {
  const sel = document.getElementById('id_product');
  const opt = sel.options[sel.selectedIndex];

  document.getElementById('harga').value = opt.dataset.harga || '';
  document.getElementById('stock').value = opt.dataset.stock || '';
  calculateTotal();
}

/**
 * Dipanggil saat jumlah pembelian berubah.
 */
function onQuantityChange() {
  calculateTotal();
}

/**
 * Menghitung total harga = harga * jumlah.
 */
function calculateTotal() {
  const harga = parseFloat(document.getElementById('harga').value) || 0;
  const qty   = parseInt(document.getElementById('quantity').value) || 0;
  document.getElementById('total_harga').value = harga * qty;
}
