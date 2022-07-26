
    <!-- <div class="onglet"></div> -->
    <div class="container">
        <div class="row mt-5 mb-3">
            <H1 class="text-center size-14">Je crée des sites simples et intuitifs pour attirer plus de clients</H1>
        </div>
        <div class="row profile m-auto">            
            <img class="profile-picture m-0 p-0" src="./Front/public/images/profile.png" alt="" srcset="">                        
        </div>
        <div class="row col m-auto">
            <p class="text-center mt-2 mb-0 name">
                David GRIGNON
            </p>
            <p class="text-center">
                Développeur Web et Marketing
            </p>
            <h2 class="text-center">
                Parlez-moi de votre projet maintenant
            </h2>
            <div class="col m-auto my-3 text-center">
                <button class="btn btn-success btn-border m-auto p-2" data-bs-toggle="modal" data-bs-target="#contactform">
                    cliquez ici&ensp;<i class="fa-solid fa-hand-pointer"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contactform" tabindex="-1" aria-labelledby="formcontact" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formcontaact">Votre projet :</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form">                                        
                        <div class="row">                        
                            <div class="col-12 col-md-6 mb-1">
                                <label for="lastname" class="form-label">Votre Nom</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" aria-describedby="lastname">                        
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <label for="firstname" class="form-label">Votre Prénom</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" aria-describedby="firstname">                        
                            </div>
                            <div class="mb-1 adress">
                                <label for="adress">Adresse :</label>
                                <input type="adress" name="adress" id="adress" class="form-control">                                           
                            </div>
                            <div class="mb-1">
                                <label for="email" class="form-label">Votre E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" aria-describedby="email">                        
                            </div>                    
                            <div class="mb-1">
                                <label for="project" class="form-label">Décrivez votre projet :</label>
                                <textarea type="text" name="project" id="project" class="form-control" aria-describedby="project">Bonjour, </textarea>                      
                            </div>
                            <div class="mb-1">
                                <button type="submit" class="btn btn-success">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>            
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
