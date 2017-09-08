<?php

class Model_stock extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function get_all_produits()
    {

        $sql = "SELECT id_produit,nom_produit,code_produit,nom_categorie,prix_achat_produit,stock_minimal_produit,quantite_total_produit FROM produit INNER JOIN categorie ON (produit.categorie_produit=categorie.id_categorie)";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

        public function get_all_users()
    {

        $sql = "SELECT id_user,nom FROM user ";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }


    public function get_produit_by_id($id_produit)
    {

        $sql = "SELECT id_produit,nom_produit,code_produit,nom_categorie,prix_achat_produit,stock_minimal_produit,quantite_total_produit FROM produit INNER JOIN categorie ON (produit.categorie_produit=categorie.id_categorie) WHERE id_produit = :id_produit LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_produit' => $id_produit);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function get_all_entrepots()
    {

        $sql = "SELECT id_entrepot,nom_entrepot FROM entrepot";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function insertion_historique($methode,$arg)
    {
        $dte = date("Y-m-d H:i:s");
        $sql1="INSERT INTO stock (produit_stock,entrepot_stock, date_stock,quantite_stock,user_stock,type_mouvement_stock,type_sortie_stock) VALUES (:produit_stock,:entrepot_stock,:dte,:quantite_stock,:user_stock,:type_mouvement_stock,:type_sortie_stock)" ;
        $query1 = $this->db->prepare($sql1) ;
        
        if($methode=='appro')
        {
            
            $arg1 = array(':produit_stock' => $arg['id_produit'], ':entrepot_stock' => $arg['entrepot_choisi'], ':dte' => $dte , ':quantite_stock' => $arg['quantite_entrepot'], ':user_stock' => $arg['user'], ':type_mouvement_stock' => 'approvisionnement', ':type_sortie_stock' => '0') ;
        }
        else if($methode=='sortie')
        {
            $arg1 = array(':produit_stock' => $arg['id_produit'], ':entrepot_stock' => $arg['entrepot_choisi'], ':dte' => $dte, ':quantite_stock' => $arg['quantite_entrepot'], ':user_stock' => $arg['user'], ':type_mouvement_stock' => 'sortie', ':type_sortie_stock' => $arg['type_sortie'] ) ;
        }
        try {
            $query1->execute($arg1) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }

    public function get_emplacement($id_produit)
    {
        $sql1= "SELECT entrepot,quantite_reel FROM repartition_produit WHERE produit= :id_produit";
        $query1 = $this->db->prepare($sql1);
        $arg1 = array(':id_produit' => $id_produit);
        $query1->execute($arg1);
        $ids_entrepots=$query1->fetchAll();
        $final=array();

        foreach ($ids_entrepots as $id_entrepot) { 
            $sql2="SELECT nom_entrepot,id_entrepot from entrepot WHERE id_entrepot= :id";
            $query2 = $this->db->prepare($sql2);
            $arg2 = array(':id' => ($id_entrepot->entrepot));
            try {
                $query2->execute($arg2) ;
            } catch (PDOException $e) {
                echo "emplacement "."$e";
                return false ; 
            }
             $nom_entrepot=$query2->fetch();
             $object = new stdClass();
             $object ->id_entrepot=$nom_entrepot->id_entrepot;
             $object ->nom_entrepot=$nom_entrepot->nom_entrepot;
             $object ->quantite_reel=$id_entrepot->quantite_reel;
             $final[]= $object;
             //array_push($final, ($nom_entrepot->nom_entrepot,$id_entrepot->quantite_reel));
        }

        return $final;
    }

    public function update_quantite_total_produit($methode,$quantite,$id_produit)
    {
        if($methode=='appro')
        {
            $sql_quantite_total="UPDATE produit SET quantite_total_produit= quantite_total_produit + :quantite_produit WHERE (id_produit=:id_produit )";
        }
        else if($methode=='sortie')
        {
            $sql_quantite_total="UPDATE produit SET quantite_total_produit= quantite_total_produit - :quantite_produit WHERE (id_produit=:id_produit )";
        }

        $query_quantite_total = $this->db->prepare($sql_quantite_total);
        $arg_quantite_total = array(':id_produit' => $id_produit, ':quantite_produit' => $quantite);
        try {
            $query_quantite_total->execute($arg_quantite_total) ;
        } catch (PDOException $e) {
            echo "$e";
            return false ; 
        }
        return true ; 
    }

    public function set_approvisionnement_produit($arg)
    {
        if($this->update_quantite_total_produit('appro',$arg['quantite_entrepot'], $arg['id_produit'])==false)
            return false ;

        if($this->insertion_historique('appro',$arg)==false)
            return false ;

        $entrepots_du_produit = $this->get_emplacement($arg['id_produit']) ;

        $sql_nom_entrepot="SELECT nom_entrepot from entrepot WHERE id_entrepot= :id_entrepot";
        $query_nom_entrepot = $this->db->prepare($sql_nom_entrepot);
        $arg_nom_entrepot = array(':id_entrepot' => $arg['entrepot_choisi']);
        try {
            $query_nom_entrepot->execute($arg_nom_entrepot);
        } catch (PDOException $e) {
            echo "$e";
            return false ; 
        }
        $nom_nouveau_entrepot=$query_nom_entrepot->fetch();
        $flag=0 ;
        $quantite_deja_existante=0 ;
        for($i=0 ; $i<sizeof($entrepots_du_produit) ; $i++)
        {
            if($entrepots_du_produit[$i]->nom_entrepot==$nom_nouveau_entrepot->nom_entrepot)
            {
                $flag=1 ;
                $quantite_deja_existante = $entrepots_du_produit[$i]->quantite_reel ;
                break ;
            }
        }

        if($flag==0)
        {
            $sql3="INSERT INTO repartition_produit (produit,entrepot,quantite_reel) VALUES(:produit,:entrepot,:quantite_reel)  ";
            $query3 = $this->db->prepare($sql3);
            $arg3 = array(':produit' => $arg['id_produit'], ':entrepot' => $arg['entrepot_choisi'] , ':quantite_reel' => $arg['quantite_entrepot']);
            try {
            $query3->execute($arg3);
            } catch (PDOException $e) {
                echo "$e";
                return false ; 
            }
        }
        else
        {

            $sql3="UPDATE repartition_produit SET quantite_reel= :qte WHERE (produit=:produit and entrepot=:entrepot )";
            $query3 = $this->db->prepare($sql3);
            $arg3 = array(':qte' => ($quantite_deja_existante+$arg['quantite_entrepot']) , ':produit' =>$arg['id_produit']  , ':entrepot'=> $arg['entrepot_choisi']  );
            try {
            $query3->execute($arg3);
            } catch (PDOException $e) {
                echo "$e";
                return false ; 
            }
        }

        return true ;
    }

    public function set_sortie_produit($arg)
    {
        if($arg['quantite_entrepot']==0)
            return true ;

        if($this->update_quantite_total_produit('sortie',$arg['quantite_entrepot'], $arg['id_produit'])==false)
            return false ;

        if($this->insertion_historique('sortie',$arg)==false)
            return false ;

        $entrepots_du_produit = $this->get_emplacement($arg['id_produit']) ;

        $sql3="UPDATE repartition_produit SET quantite_reel= quantite_reel - :quantite_reel WHERE (produit=:produit and entrepot=:entrepot )";
        $query3 = $this->db->prepare($sql3);
        $arg3 = array(':quantite_reel' => $arg['quantite_entrepot'] , ':produit' =>$arg['id_produit']  , ':entrepot'=> $arg['entrepot_choisi']  );
        try {
        $query3->execute($arg3);
        } catch (PDOException $e) {
            echo "$e";
            return false ; 
        }

        return true ;
    }

    public function get_all_historique($arg='')
    {
        if($arg=='')
        {
            $sql_historique = "SELECT * FROM stock INNER JOIN produit ON produit.id_produit=stock.produit_stock  INNER JOIN entrepot ON entrepot.id_entrepot=stock.entrepot_stock INNER JOIN user ON user.id_user=stock.user_stock " ; 
            $query_historique = $this->db->prepare($sql_historique) ; 
            $query_historique->execute() ;
            return $query_historique->fetchAll() ; 
        }
        else
        {
            $flag = false ; 
            $sql_produit_stock = '' ; 
            $sql_entrepot_stock = '' ; 
            $sql_date_stock = '' ; 
            $sql_user_stock = '' ;            
            $sql_type_mouvement_stock = '' ;
            $parameters =  array() ;

            if($arg['produit_stock']!='0')
            {
                $sql_produit_stock = "produit_stock = :produit_stock " ;
                $parameters[':produit_stock'] = $arg['produit_stock'] ; 
                $flag = true ;
            }
            if($flag==true && $arg['entrepot_stock']!='0')
                $sql_entrepot_stock = " AND " ; 

            if($arg['entrepot_stock']!='0')
            {
                $parameters[':entrepot_stock'] = $arg['entrepot_stock'] ;
                $sql_entrepot_stock = $sql_entrepot_stock .  " entrepot_stock = :entrepot_stock " ;
                $flag = true ;
            }

            if($flag==true && $arg['date_stock_1']!='0')
                $sql_date_stock = " AND " ; 

            if($arg['date_stock_1']!='0' || $arg['date_stock_2']!='0')
            {
                if($arg['date_stock_2']=='0' && $arg['date_stock_1']!='0') $parameters[':date_stock_2'] = $arg['date_stock_1'] ; 
                if($arg['date_stock_1']=='0' && $arg['date_stock_2']!='0') $parameters[':date_stock_1'] = $arg['date_stock_2'] ; 
                $parameters[':date_stock_1'] = $arg['date_stock_1'] ;
                $parameters[':date_stock_2'] = $arg['date_stock_2'] ; 
                $sql_date_stock = $sql_date_stock . " date_stock BETWEEN :date_stock_1 AND :date_stock_2 " ;
                $flag = true ;
            }

            if($flag==true && $arg['user_stock']!='0')
                $sql_user_stock = " AND " ; 

            if($arg['user_stock']!='0')
            {
                $parameters[':user_stock'] = $arg['user_stock'] ; 
                $sql_user_stock = $sql_user_stock . " user_stock = :user_stock" ;
                $flag = true ;
            }

            if($flag==true && $arg['type_mouvement_stock']!='0')
                $sql_type_mouvement_stock = $sql_type_mouvement_stock . " AND " ; 

            if($arg['type_mouvement_stock']!='0')
            {
                $parameters[':type_mouvement_stock'] = $arg['type_mouvement_stock'] ; 
                $sql_type_mouvement_stock = $sql_type_mouvement_stock . " type_mouvement_stock = :type_mouvement_stock" ;
            }
 
            $sql_historique = "SELECT * FROM stock INNER JOIN produit ON produit.id_produit=stock.produit_stock  INNER JOIN entrepot ON entrepot.id_entrepot=stock.entrepot_stock INNER JOIN user ON user.id_user=stock.user_stock  WHERE ".$sql_produit_stock.$sql_entrepot_stock.$sql_date_stock.$sql_user_stock.$sql_type_mouvement_stock ;

            $query_historique = $this->db->prepare($sql_historique) ; 
            $query_historique->execute($parameters) ;
            return $query_historique->fetchAll() ; 
        }
    }
}


