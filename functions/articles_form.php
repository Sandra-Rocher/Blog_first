test pr iframe :

    youtube donne ca comme lien qd on le copy integer partager
    <iframe width="560" height="315" src="https://www.youtube.com/embed/RA345H11Djc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        bootstrap donne ca au départ (je l'ai pris en 21by9, mais si c'est trop grand mettre : 16by9):
        <div class="embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="..."></iframe>
        </div>
        donc seul la src doit etre modifié 


    <div class="embed-responsive embed-responsive-21by9">
        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/RA345H11Djc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
            <!-- Autre exemple pr montrer la diff ci dessous : -->
        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/k0BWlvnBmIE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            

            Donc au final : 
            on rete en width 560 et 315 quand on faire en grid mais quand on ouvre le full article : on change par ça : teté et approuvé :


            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="1200" height="700" src="https://www.youtube.com/embed/RA345H11Djc" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>




            controler               c est le js mes functions
            model                   c est la database solo
            vue view template       c est le ejs mes .php
            assett ou public        js image css normalement que image mais bon
            il restera .htaccess et index.php : ce sont les seuls qui ne sont pas dans des dossiers
            