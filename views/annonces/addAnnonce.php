<?php

$pageTitle = "Publication d'annonce";

ob_start(); ?>

 
<div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <p class="text-center text-bg-danger">
                                        <?php if(isset($message)) echo $message; ?>
                                    </p>

                                        <h3 class="text-center font-weight-light my-4">Nouvelle annonce</h3></div>
                                    <div class="card-body">
                                        <form action="<?=ROOT?>/annonce/registerAnnonce" method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="titre" type="text" name="titre" />
                                                        <label for="titre">Titre</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="description" type="text" name="description" /></textarea>
                                                        <label for="description">Une coutre description</label>
                                                    
                                                </div>
                                            
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="nombre_pieces" type="text" name="nombre_pieces" />
                                                        <label for="nombre_pieces">Nombre de pièces</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="tarif_mensuel" type="text" name="tarif_mensuel" />
                                                        <label for="tarif_mensuel">Tarif mensuel</label>
                                                    </div>
                                                </div>
                                            </div>

                                             <div>
                                                <label for="image">Photo de l'annonce</label>
                                                <input type="hidden" name="MAXE_FILE_SISE" value="10000000" />
                                                <input type="file" name="image" id="image">
                                                        
                                              </div>

                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <input type="submit" name="registerAnnonce" value="Publier" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>



<?php
$content = ob_get_clean();

include('views/includes/template.php');