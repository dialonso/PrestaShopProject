<?php 
class FrontController extends FrontControllerCore{
	
    public function initContent(){
		parent::initContent();
		
		$connection = mysqli_connect("127.0.0.1","root","") or die(mysqli_error());
		mysqli_select_db($connection,"prestashop") or die(mysql_error());
		
		//var_dump($this);
		//echo "<h1>" . $_GET['controller'] . "</h1>";
		//var_dump($_GET);
						
		$requete = "SELECT * FROM tp5_seo_rules WHERE controller = '".$_GET['controller']."';";
		$reponse = mysqli_query($connection,$requete) or die(mysqli_error());
		
		while ($donnee = mysqli_fetch_array($reponse)){
			$title=$donnee["baseline_title"];
			$description=$donnee["baseline_description"];
		}
	
		
		if($_GET['controller'] == 'index'){			

			echo "<div class='referencement'>$title $description</div>";
			$name = 'EasyPoster';	
		
		}else if($_GET['controller'] == 'contact'){
			echo "<div class='referencement'>$title $description</div>";
			$name = 'Contactez-nous';
			
		}else if($_GET['controller'] == 'stores'){	
			echo "<div class='referencement'>$title $description</div>";
			$name = 'Magasins';	
			
		}else if($_GET['controller'] == 'cms'){			
			echo "<div class='referencement'>$title $description</div>";
			$name="Marques";
			
		}else if($_GET['controller'] == 'category'){
			$requete = "SELECT * FROM tp5_seo_rules WHERE controller = '".$_GET['controller']."' AND identifiant='".$_GET['id_category']."';";
			$reponse = mysqli_query($connection,$requete) or die(mysqli_error());
			
			while ($donnee = mysqli_fetch_array($reponse)){
				$title=$donnee["baseline_title"];
				$description=$donnee["baseline_description"];
			}
			echo "<div class='referencement'>$title $description</div>";
		
			$query = 'SELECT name FROM tp5_category_lang WHERE id_category= '.$_GET["id_category"].';';
			$result = mysqli_query($connection,$query) or die(mysqli_error());
						
			while ($data = mysqli_fetch_array($result)){
				$name=$data["name"];
			}


			
		}else if($_GET['controller'] == 'product'){
			echo "<div class='referencement'>$title $description</div>";
			
			$query = 'SELECT name FROM tp5_product_lang WHERE id_product= '.$_GET["id_product"].';';
			$result = mysqli_query($connection,$query) or die(mysqli_error());
			
			while ($data = mysqli_fetch_array($result)){
				$name=$data["name"];
			}
		}
		
		$this->context->smarty->assign('seo_title',$name);

        //exit;
    }
}
?>