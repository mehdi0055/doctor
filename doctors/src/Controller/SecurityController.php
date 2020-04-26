<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\User;
use Twig\Environment;
use App\Entity\Enfants;
use App\Entity\Parents;
use App\Entity\Pediatres;
use App\Entity\Commentair;
use App\Entity\SessionChat;
use App\Entity\CategorieBlog;
use Twig\Loader\LoaderInterface;
use App\Repository\BlogRepository;
use App\Repository\UserRepository;

use App\Security\UserAuthenticator;
use App\Repository\EnfantsRepository;
use App\Repository\ParentsRepository;
use App\Repository\PediatresRepository;

use App\Repository\CommentairRepository;
use App\Repository\SessionChatRepository;
use App\Repository\CategorieBlogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/Deconnexion", name="app_logout")
     */
    public function logout()
    {
       return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/index", name="index")
     */
    public function index()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $pediatre = $entityManager->getRepository(Pediatres::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $parent = $entityManager->getRepository(Parents::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $enfant = $entityManager->getRepository(Enfants::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $blog = $entityManager->getRepository(Blog::class)->findAll();

        $countUser=count($users);
        $countPediatre=count( $pediatre);
        $countParent=count($parent);
        $countEnfant=count($enfant);
        $countBlog=count($blog);


        

            return $this->render('index.html.twig',['countUser'=>$countUser,'countPediatre'=>$countPediatre,'countParent'=>$countParent,'countEnfant'=>$countEnfant,'pediatre'=>$pediatre,'enfant'=>$enfant,'countBlog'=>$countBlog]);


    }

    /**
     * @Route("/Addinscription", name="Addinscription")
     */
    public function Addinscription(UserPasswordEncoderInterface $passwordEncoder)
    {
        

        $entityManager = $this->getDoctrine()->getManager();

        $User = new User();

        $roles[] = 'ROLE_'.$_POST['role'];


        $hach=$passwordEncoder->encodePassword(
            $User,
            $_POST['password']);



        $User->setEmail($_POST['email']);
        $User->setNameComplet($_POST['name']);
        $User->setRoles($roles);
      $User->setPassword($hach);

        $entityManager->persist($User);
        $entityManager->flush();


        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->getUser($_POST['email']);

        foreach ($users as $u) {

       if ($u){

    $idUser=$u->getId();


       }

        }



        if ($_POST['role']=='PARENT') {


            $entityManager = $this->getDoctrine()->getManager();

            $parent = new Parents();
    
           
    
    
           
    
    
            $parent->setIdUser((int)$idUser);
            $parent->setEmail($_POST['email']);
            $parent->setNomComplete($_POST['name']);
            $parent->setTele((int)$_POST['tele']);
    
           
         
    
            $entityManager->persist($parent);
            $entityManager->flush();
    
    
    
            $this->addFlash('successAdd','successAdd');
    
    
        
    
    
            return $this->render('inscription.html.twig');




        }

        else if ($_POST['role']=='PEDIATRE') {


            $entityManager = $this->getDoctrine()->getManager();

            $pediatre = new Pediatres();
    
           
    
    
           
    
    
            $pediatre->setIdUser((int)$idUser);
            $pediatre->setEmail($_POST['email']);
            $pediatre->setNomComplet($_POST['name']);
            $pediatre->setTele((int)$_POST['tele']);
    
           
         
    
            $entityManager->persist($pediatre);
            $entityManager->flush();
    
    
    
            $this->addFlash('successAdd','successAdd');
    
    
        
    
    
            return $this->render('inscription.html.twig');




        }

     

    }

    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        


        return $this->render('inscription.html.twig');

    }


      /**
     * @Route("/chat", name="chat")
     */
    public function chat()
    {

      if (isset($_POST['envoyer'])) {

        $idDestinatair = $_GET['idDestinatair'];
        $emailDestinateur=$_GET['emailDestinateur'];

        $entityManager = $this->getDoctrine()->getManager();
        $UserDestinatair = $entityManager->getRepository(User::class)->find($idDestinatair);
 
        $entityManager = $this->getDoctrine()->getManager();
        $listUser = $entityManager->getRepository(User::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
    
        $session = new SessionChat();


        $session->setDestinateurEmail($emailDestinateur);
        $session->setDestinatairEmail($UserDestinatair->getEmail());
        $session->setMessage($_POST['message']);
    
       


        $entityManager->persist($session);
        $entityManager->flush();

        $entityManager = $this->getDoctrine()->getManager();
        $sessionn = $entityManager->getRepository(SessionChat::class)->findAll();

   

        return $this->redirectToRoute('refraiche',['idDestinatair'=>$idDestinatair,'emailDestinateur'=>$emailDestinateur]);
     





      }

       

        else if (isset($_GET['idDestinatair'])){

       $idDestinatair = $_GET['idDestinatair'];
       $emailDestinateur=$_GET['emailDestinateur'];

       $entityManager = $this->getDoctrine()->getManager();
       $UserDestinatair = $entityManager->getRepository(User::class)->find($idDestinatair);

       $entityManager = $this->getDoctrine()->getManager();
       $listUser = $entityManager->getRepository(User::class)->findAll();

       $entityManager = $this->getDoctrine()->getManager();
       $sessionn = $entityManager->getRepository(SessionChat::class)->getSessions($emailDestinateur,$UserDestinatair->getEmail());


   
      

           return $this->render('chat.html.twig',['UserDestinatair'=>$UserDestinatair,'listUser'=>$listUser,'session'=>$sessionn]);
    


     

      


        } else {

           


           
   
         
   
   
            $entityManager = $this->getDoctrine()->getManager();
            $listUser = $entityManager->getRepository(User::class)->findAll();


            return $this->render('chat.html.twig',['listUser'=>$listUser]);


        }

       

    

    }

 
      /**
     * @Route("/refraiche", name="refraiche")
     */
    public function refraiche()
    {
        $idDestinatair=$_GET['idDestinatair'];
        $emailDestinateur=$_GET['emailDestinateur'];

        $entityManager = $this->getDoctrine()->getManager();
        $UserDestinatair = $entityManager->getRepository(User::class)->find($idDestinatair);
 
        $entityManager = $this->getDoctrine()->getManager();
        $listUser = $entityManager->getRepository(User::class)->findAll();
 
        $entityManager = $this->getDoctrine()->getManager();
        $sessionn = $entityManager->getRepository(SessionChat::class)->getSessions($emailDestinateur,$UserDestinatair->getEmail());


        return $this->render('chat.html.twig',['UserDestinatair'=>$UserDestinatair,'listUser'=>$listUser,'session'=>$sessionn]);


    }





        /**
     * @Route("/medicament", name="medicament")
     */
    public function medicament()
    {
        


        return $this->render('Medicament.html.twig');

    }


         /**
     * @Route("/addMedicament", name="addMedicament")
     */
    public function addMedicament()
    {
        


        return $this->render('addMedicament.html.twig');

    }





    /**
     * @Route("/users", name="users")
     */
    public function users()
    {

        if (isset($_POST['send'])){

            $role=$_POST['role'];


            $entityManager = $this->getDoctrine()->getManager();
            $users = $entityManager->getRepository(User::class)->findAll();



            if ($users){



                foreach($users as $u){


                    

                        while ($u->getRoles()[0] == $role) {




                            $iduser=$u->getId();
    
                            $entityManager = $this->getDoctrine()->getManager();
                            $users = $entityManager->getRepository(User::class)->getUserRole($iduser);
    
    
                            return $this->render('Users.html.twig',['user'=>$users]);
    
    
                        }


                    

                  

                
                }
            }

       

            

        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('Users.html.twig',['user'=>$users]);

    }


       /**
     * @Route("/Parents", name="Parents")
     */
    public function Parents()
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $parent = $entityManager->getRepository(Parents::class)->findAll();

        return $this->render('parent.html.twig',['parent'=>$parent]);

    }



    /**
     * @Route("/orientation", name="orientation")
     */
    public function orientation()
    {
        


        return $this->render('orientation.html.twig');

    }


    /**
     * @Route("/enfants", name="enfants")
     */
    public function enfants()
    {

        if (isset($_GET['id'])){

            $id=$_GET['id'];


            $entityManager = $this->getDoctrine()->getManager();
            $enfant = $entityManager->getRepository(Enfants::class)->findAll();
    
            $entityManager = $this->getDoctrine()->getManager();
            $parent = $entityManager->getRepository(Parents::class)->getParent($id);



            
   if ($parent) {


    foreach ($parent as $p) {

        $entityManager = $this->getDoctrine()->getManager();
        $enfantt = $entityManager->getRepository(Enfants::class)->getEnfant($p->getId());


        return $this->render('enfants.html.twig',['enfantt'=>$enfantt]);

    }

    


   }

   return $this->render('enfants.html.twig',['enfant'=>$enfant]);

        }

       
        


        $entityManager = $this->getDoctrine()->getManager();
        $enfant = $entityManager->getRepository(Enfants::class)->findAll();




   return $this->render('enfants.html.twig',['enfant'=>$enfant]);

      

   


      

    }




    /**
     *@Route("/profilEnfant/{id}", name="profilEnfant")
     */
    public function profilEnfant($id)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $enfant = $entityManager->getRepository(Enfants::class)->find($id);
        


        return $this->render('profilEnfant.html.twig',['enfant'=>$enfant]);

    }


        /**
     *@Route("/profilPediatre/{id}", name="profilPediatre")
     */
    public function profilPediatre($id)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $pediatre = $entityManager->getRepository(Pediatres::class)->find($id);
        


        return $this->render('profilPediatre.html.twig',['pediatre'=>$pediatre]);

    }

    
        /**
     *@Route("/profilPediatre1/{id}", name="profilPediatre1")
     */
    public function profilPediatre1($id)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $pediatre = $entityManager->getRepository(Pediatres::class)->getPediatree($id);


        return $this->redirectToRoute('profilPediatre',['id'=>$pediatre[0]->getId()]);
        


       

    }

   


          /**
     * @Route("/pediatre", name="pediatre")
     */
    public function pediatre()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pediatre = $entityManager->getRepository(Pediatres::class)->findAll();


        return $this->render('pediatre.html.twig',['pediatre'=>$pediatre]);

    }


    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {


        if (isset($_GET['idCat'])){

            $idCat=$_GET['idCat'];


            $entityManager = $this->getDoctrine()->getManager();
            $blog = $entityManager->getRepository(Blog::class)->getBlog($idCat);

            return $this->render('blog.html.twig',['blog'=>$blog]);


        }




       

            $entityManager = $this->getDoctrine()->getManager();
            $blog = $entityManager->getRepository(Blog::class)->findAll();
            
    
    
            return $this->render('blog.html.twig',['blog'=>$blog]);

        

      

    }

        /**
     * @Route("/addBlog/{email}", name="addBlog")
     */
    public function addBlog($email)
    {

     


        if (isset($_POST['inserer'])){

       
            $entityManager = $this->getDoctrine()->getManager();
            $cat = $entityManager->getRepository(CategorieBlog::class)->findAll();
          

            $filename = $_FILES['imageBlog']['name'];

            move_uploaded_file($_FILES['imageBlog']['tmp_name'],'assets/img/blog/'.$filename);



          return $this->render('ajouterBlog.html.twig',['cat'=>$cat,'fileName'=>$filename]);



        } else if (isset($_POST['publier'])) {

            $entityManager = $this->getDoctrine()->getManager();
            $cat = $entityManager->getRepository(CategorieBlog::class)->findAll();
    
    
    
            $entityManager = $this->getDoctrine()->getManager();
            $catt = $entityManager->getRepository(CategorieBlog::class)->getidCat($_POST['cat']);
    
    
            if ($catt) {
    
    
                $idcat=$catt[0]->getid();
            }
    
    
            $entityManager = $this->getDoctrine()->getManager();
    
            $blog = new Blog();
    
    
            $blog->setTitre($_POST['nom']);
            $blog->setIdCategorieBlog($idcat);
            $blog->setDateBlog(new \DateTime('now'));
            $blog->setImageBlog($_POST['fil']);
            $blog->setDescription($_POST['desc']);

            $entityManager = $this->getDoctrine()->getManager();
            $pediatre = $entityManager->getRepository(Pediatres::class)->getPediatre($email);



            $blog->setIdPediatre($pediatre[0]->getId());
    
    
    
    
    
    
    
            $entityManager->persist($blog);
            $entityManager->flush();
    
            
    
            return $this->redirectToRoute('blog');

        } else

        $entityManager = $this->getDoctrine()->getManager();
        $cat = $entityManager->getRepository(CategorieBlog::class)->findAll();

        
        return $this->render('ajouterBlog.html.twig',['cat'=>$cat]);

  

    }



       /**
     * @Route("/detailBlog/{id}", name="detailBlog")
     */
    public function detailBlog($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $blog = $entityManager->getRepository(Blog::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $cat = $entityManager->getRepository(CategorieBlog::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $cmnt = $entityManager->getRepository(Commentair::class)->getcmnt($id);

        $countComment=count($cmnt);


        if ($blog){

            $entityManager = $this->getDoctrine()->getManager();
            $pediatre = $entityManager->getRepository(Pediatres::class)->getnomPediatre($blog->getIdPediatre());
          
           
        }
        


        return $this->render('detailBlog.html.twig',['blog'=>$blog,'pediatre'=>$pediatre[0]->getNomComplet(),'cat'=>$cat,'cmnt'=>$cmnt,'countComment'=>$countComment]);

    }


        /**
     * @Route("/addCommentair/{id}", name="addCommentair")
     */
    public function addCommentair($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $blog = $entityManager->getRepository(Blog::class)->find($id);



        if (!$blog){


            throw $this->createNotFoundException(
                'No blog found for id '.$id
            );



         
        }

        $countCommentair=$blog->getCountComment()+1;

        $blog->setCountComment((int)$countCommentair);

        $entityManager->flush();





        $entityManager = $this->getDoctrine()->getManager();
        $pediatre = $entityManager->getRepository(User::class)->getUser($_GET['email']);

        
        $entityManager = $this->getDoctrine()->getManager();
    
        $Commentair = new Commentair();


        $Commentair->setEmail($_GET['email']);
        $Commentair->setIdArticles($id);
        $Commentair->setCmnt($_GET['Comments']);

        $Commentair->setImage($pediatre[0]->getImage());
        $Commentair->setDateComment(new \DateTime('now'));
        $Commentair->setNom($pediatre[0]->getNameComplet());
     







        $entityManager->persist($Commentair);
        $entityManager->flush();

        return $this->redirectToRoute('detailBlog', ['id' => $id]);

    }



    /**
     * @Route("/liked/{id}", name="liked")
     */
    public function liked($id)
    {

     
        $entityManager = $this->getDoctrine()->getManager();
        $blog = $entityManager->getRepository(Blog::class)->find($id);



        if (!$blog){


            throw $this->createNotFoundException(
                'No blog found for id '.$id
            );



         
        }

        $countJaime=$blog->getIdJaime()+1;

        $blog->setIdJaime((int)$countJaime);

        $entityManager->flush();

        return $this->redirectToRoute('blog',['id'=>$id]);
        


      

    }
















}

?>
