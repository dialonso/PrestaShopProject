
<?php 
class SearchController extends SearchControllerCore{
	
    public function initContent(){
		
		$connection = mysqli_connect("127.0.0.1","root","") or die(mysqli_error());
		mysqli_select_db($connection,"prestashop") or die(mysql_error());
				
		if(strlen($_GET["s"])<5){
			$query = 'SELECT id_category AS id, CL.link_rewrite AS categ FROM tp5_product P, tp5_category_lang CL WHERE id_category_default=id_category AND reference LIKE "%'.$_GET["s"].'%";';
			$result = mysqli_query($connection,$query) or die(mysqli_error());
			
			while ($data = mysqli_fetch_array($result)){
				$category=$data["categ"];
				$numCateg=$data["id"];
			}
			header("location:$numCateg-$category");
			
		}else if(strlen($_GET["s"])==5){
			
			$query = 'SELECT P.id_product AS id, PL.link_rewrite AS nom, CL.link_rewrite AS categ FROM tp5_product P, tp5_product_lang PL, tp5_category_lang CL WHERE P.id_product=PL.id_product AND id_category_default=id_category AND reference="'.$_GET["s"].'";';
			$result = mysqli_query($connection,$query) or die(mysqli_error());
					
			while ($data = mysqli_fetch_array($result)){
				
				$category=$data["categ"];
				$numProduit=$data["id"];
				$nomProduit=$data["nom"];
			}
			
			header("location:$category/$numProduit-$nomProduit.html");
		}
    }
}

?>
