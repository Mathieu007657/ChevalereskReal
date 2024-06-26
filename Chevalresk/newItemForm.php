<?php
    require 'php/sessionManager.php';
    $viewTitle = "Ajout d'item";
    $currentUserId = (int)$_SESSION["currentUserId"];
    userAccess();
    $newImage = true;
    $image = "images/PhotoCloudLogo.png";
    $viewContent = <<< HTML

    <div class="content loginForm">
        <br>
        <form method='post' action='newItem.php'>
            <input type="hidden" name = "OwnerId" value=$currentUserId >
            <fieldset>
                <legend>Informations</legend>
                <input  type="text" 
                        class="form-control Alpha" 
                        name="Title" 
                        id="Title"
                        placeholder="Titre" 
                        required 
                        RequireMessage = 'Veuillez entrer un titre'
                        InvalidMessage = 'Le titre contient des caractères spéciaux' />

                <textarea   class="form-control Alpha" 
                            name="Description" 
                            id="Description"
                            placeholder="Description" 
                            rows="4"
                            required 
                            RequireMessage = 'Veuillez entrer une Description'>
                </textarea>
            </fieldset>
            <fieldset>
                <legend>Image</legend>
                <div class='imageUploader' 
                        newImage='$newImage' 
                        controlId='Image' 
                        imageSrc='$image' 
                        required 
                        RequireMessage = 'Veuillez entrer une image'
                        waitingImage="images/Loading_icon.gif">
            </div>
            </fieldset>
            <input type='submit' name='submit' value="Enregistrer" class="form-control btn-primary">
        </form>
        <div class="cancel">
            <a href="itemsList.php">
                <button class="form-control btn-secondary">Annuler</button>
            </a>
        </div>

    </div>
    HTML;
    $viewScript = <<<HTML
        <script src='js/validation.js'></script>
        <script src='js/imageControl.js'></script>
        <script defer>
            initFormValidation();
            $("#addPhotoCmd").hide();
        </script>
    HTML;
    include "views/master.php";


