<?php

$pageTitle = "Page d'accueil";

ob_start();

?>

        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <p class="text-center text-bg-danger">
                    <?php if(isset($message)) echo $message; ?></p>
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?=ROOT?>/public/img/<?=$annonce['image']?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div><h4><?=$annonce['nombre_pieces']?> pièces</h4></div>
                        <h1 class="display-5 fw-bolder"><?=$annonce['titre'] ?></h1>
                        <div class="fs-5 mb-5">
                            <span><?=$annonce['tarif_mensuel']?> €</span>

						</div>
						<p class="lead"><?=$annonce['description']?></p>

                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-left">
                                	<a class="btn btn-outline-dark mt-auto" href="<?=ROOT?>/annonce/updateAnnonce/<?=$annonce['id'] ?>">Modifier
                                	</a>


                                	<a class="btn btn-outline-dark mt-auto" href="<?=ROOT?>/annonce/deleteAnnonce/<?=$annonce['id'] ?>" onclick="return confirm('Étes vous sûr de vouloir supprimer cette annonce?')">Supprimer
                                	</a>

                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </section>


<?php

$content = ob_get_clean();

include('views/includes/template.php');