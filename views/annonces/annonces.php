<?php

$pageTitle = "Page d'accueil";

ob_start();

?>

   <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            	<p class="text-center text-bg-danger">
            		<?php if(isset($message)) echo $message; ?> </p>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                	<?php foreach ($annonces as $annonce): ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?=ROOT?>/public/img/<?=$annonce['image']?>" alt="Annonce" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=$annonce['titre']?></h5>
                                    <!-- Product price-->
                                    <?=$annonce['nombre_pieces']?> pièces.
                                    <br>
                                    <?=$annonce['tarif_mensuel'] ?> €.
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                	<a class="btn btn-outline-dark mt-auto" href="<?=ROOT?>/annonce/getAnnonceById/<?=$annonce['id'] ?>">Afficher
                                	</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach; ?>
                </div>
            </div>
        </section>



<?php
$content = ob_get_clean();

include('views/includes/template.php');