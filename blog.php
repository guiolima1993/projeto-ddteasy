<?php $_password = true ?>
<?php include('header.php'); ?>


<div class="blog-background">
    <div class="container">
    <nav class="nav-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
      </nav>

    <div class="content-blog">
    <?php    
          $q = Query('SELECT * FROM blog_banner WHERE Ativo = 1 ORDER BY Blog_banner DESC LIMIT 5',0);
          if(mysqli_num_rows($q) > 0){
    ?>
        <section class="blog-carousel">
            <div class="basic-carousel owl-carousel" data-autoplay="true" data-nav="false" data-items="1" data-dots="false" data-loop="true">
            <?php  while($r = mysqli_fetch_assoc($q)){    ?>
              <div class="item" href="<?php echo $r['Link'];   ?>">
                <div class="owl-text d-flex justify-content-center">
                  <img onclick="location.href='#cards-news.php'" src="<?php echo $Config['UrlSite'];  ?>imagens/blog_banner/1680/<?php echo $r['Imagem']; ?>">
                </div>
              </div>
          <?php   } ?>
            </div>
          </section>   
      <?php  }   ?>

    <div class="last-news">
        <div class="title-news mb-3">
          <h3>Últimas notícias</h3>
        </div>
    <form>
        <div class="input-group mb-5">
          <input type="text" class="form-control" placeholder="Buscar por título" name="Termo" aria-label="Recipient's username"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-search" type="submit">Pesquisar</button>
        </div>
    </form>
      </div>
    
    
    <div class="card-area">
    <?php  
         $pag = ($_GET['pag']);
    $pag = filter_var($pag, FILTER_VALIDATE_INT);

    $inicio = 0;
    $limite = 10;

    if ($pag!='')
    {
        $inicio = ($pag - 1) * $limite;
    } 

 
        if(isset($_GET['Termo']) && $_GET['Termo']!=''){

            $url = clean($_GET['Termo']);


                $busca_total = Query('SELECT COUNT(*) as total FROM blog WHERE Ativo = 1 AND (Titulo LIKE "%'.$url.'%" ||  Texto LIKE "%'.$url.'%")',0);

                $total = mysqli_fetch_assoc($busca_total);   
                $total = $total['total']; 


            $q = Query('SELECT * FROM blog WHERE Ativo = 1 AND (Titulo LIKE "%'.$url.'%" ||  Texto LIKE "%'.$url.'%") ORDER BY Blog DESC LIMIT '.$inicio.','.$limite.'',0);
        
        }else{
             $busca_total = Query('SELECT COUNT(*) as total FROM blog WHERE Ativo = 1',0);

                       $total = mysqli_fetch_assoc($busca_total);
                $total = $total['total']; 
            $q = Query('SELECT * FROM blog WHERE Ativo = 1 ORDER BY Blog DESC LIMIT '.$inicio.','.$limite.'',0);
        
        }

        if(mysqli_num_rows($q) > 0){
        while($r_blog = mysqli_fetch_assoc($q)){    
    ?>
        <div onclick="location.href='<?php echo $Config['UrlSite'];   ?>cards-news/<?php echo $r_blog['Url'];   ?>'" class="card-news d-flex mb-3">
            <div class="image-news">
                <img src="<?php echo $Config['UrlSite'];   ?>imagens/blog/200/<?php echo $r_blog['Imagem'];   ?>" alt="imagem-lorem">
            </div>
          <div class="content-info">
            <div class="title-news">
                <h4><?php echo $r_blog['Titulo'];   ?></h4>
            </div>
            <div class="news-short">
                <p><?php echo $r_blog['Resumo'];   ?></p>
            </div>
          </div>
        </div>
    <?php   }   ?>

    </div>
<?php         
                        $prox = $pag + 1;
                        $ant = $pag - 1;
                        $ultima_pag = ceil($total / $limite);
                        $penultima = $ultima_pag - 1;   
                        $adjacentes = 2;
                        
                        echo '                <div class="pagination-cards">
                    <nav aria-label="Page navigation"> <ul class="pagination">';
                        
                        if ($pag>1)
                        {
                            $paginacao = '<li class="page-item"><a class="page-link"  href="'.$Config['UrlSite'].'blog.php?pag='.$ant.$get.'">anterior</a></li>';
                        }
                        
                        if ($ultima_pag <= 5)
                        {
                            for ($i=1; $i< $ultima_pag+1; $i++)
                            {
                                if ($i == $pag)
                                {
                                    $paginacao .= '<li class="page-item"><a class="atual page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';                
                                } else {
                                    $paginacao .= '<li class="page-item"><a  class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';  
                                }
                            }
                        } 

                        if ($ultima_pag > 5)
                        {
                            if ($pag < 1 + (2 * $adjacentes))
                            {
                                for ($i=1; $i< 2 + (2 * $adjacentes); $i++)
                                {
                                    if ($i == $pag)
                                    {
                                        $paginacao .= '<li class="page-item"><a  class="atual page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';                
                                    } else {
                                        $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';  
                                    }
                                }
                                $paginacao .= '...';
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$penultima.$get.'">'.$penultima.'</a></li>';
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$ultima_pag.$get.'">'.$ultima_pag.'</a></li>';
                            }
                            elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3)
                            {
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag=1'.$get.'">1</a></li>';                
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag=1'.$get.'">2</a></li> ... ';   
                                for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++)
                                {
                                    if ($i == $pag)
                                    {
                                        $paginacao .= '<li class="page-item"><a class="atual page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';                
                                    } else {
                                        $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';  
                                    }
                                }
                                $paginacao .= '...';
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$penultima.$get.'">'.$penultima.'</a></li>';
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$ultima_pag.$get.'">'.$ultima_pag.'</a></li>';
                            }
                            else {
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag=1'.$get.'">1</a></li>';                
                                $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag=1'.$get.'">2</a></li> ... ';   
                                for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++)
                                {
                                    if ($i == $pag)
                                    {
                                        $paginacao .= '<a class="page-link atual" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';                
                                    } else {
                                        $paginacao .= '<a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$i.$get.'">'.$i.'</a></li>';  
                                    }
                                }
                            } 
                        }
 
                        if ($prox <= $ultima_pag && $ultima_pag > 2)
                        {
                            $paginacao .= '<li class="page-item"><a class="page-link" href="'.$Config['UrlSite'].'blog.php?pag='.$prox.$get.'">pr&oacute;xima &raquo;</a></li>';
                        }
                        
                        echo $paginacao;
                        echo '</ul></div></div>';





}
    ?>

  </div>
</div>
</div>

</div>

<?php include('footer.php'); ?>

</body>

</html>