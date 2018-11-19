//Il controller che serve per mostrare i prodotti per la prima pagina
//

function productUpdateController($rootScope,$scope,$http,$window){
	//var scope = $rootScope;
	//scope.product = {name:"",price:"",discount:"",totalPrice:"",rating:"",img:""}
	scope = $rootScope;
  scope.npage=0;
  scope.list=[];
  var ncall = 0;



  //Faccio una richiesta per fami dare i prodotti in prima pagina
  scope.getProductsByPage = function(page){ 
    var req = {
      method: 'GET',
      url: '/api/products?page='+page,

      headers: { 'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer '+window.localStorage.getItem("token2")
    }

  };
  //Con la prima chiamata http mi prendo i prodotti in prima pagina
    $http(req)
    .success(function(response){
      ncall=1;
      console.log(response);
      for(let i=0;i<response.data.length;i++){
        scope.product = response.data[i];
        scope.list.push(scope.product);

      }

      scope.npage = response.meta.last_page;
      scope.pList = scope.list;
      scope.list = [];
    })
    .error(function(response){
      console.log(response);
      alert("Qualcosa è andato storto!");
    });
  };
//$window.onload=scope.getProductsByPage(0);
//Faccio una prima chiamata per i prodotti in prima pagina
if(ncall==0){
  scope.getProductsByPage(1);

}

  scope.deleteProduct = function(productUrl){
    console.log(productUrl);
    var bool = confirm("Vuoi eliminare il prodotto?");
    if(!bool) return;
    var req = {
      method: 'DELETE',
      url: productUrl,

      headers: { 'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': 'Bearer '+window.localStorage.getItem("token2")
      }

    };

    $http(req)
    .success(function(response) {
                        
      alert("Prodotto eliminato correttamente!");
    })
    .error(function(response) {
    alert("Si è verificato un errore!");
    console.log(response);
    });

  }


};