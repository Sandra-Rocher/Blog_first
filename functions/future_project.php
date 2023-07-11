
<!-- todo SRO : a finir : pr les retrouver : shift ctrl + f = rechercher / sinon shift alt et f pour auto indent-->


------ TODOLISt : 

delete in cascade -> stock avatar

js input non vidé

indentation pages




------ Possible évolution : 

pas d'avatar obligatoire ? photo par défaut

upload de plusieurs photos, ou de vidéos 

paging / graphicart php html 8mn 9.46 ajout de title sur pages

favoris

page informations + mention legales : si fait : rajouter vidéos favoris 

fleche pour remonter en haut de la pagee

modif profil get/post/$data dans l url

refactorisation 

autosearch

graphicart tuto php like ou dislike 24.27 







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




<!-- Pour reclasser les fichiers correctement : 
            controler               c est le js mes functions
            model                   c est la database solo
            vue view template       c est le ejs mes .php
            assett ou public        js image css normalement que image mais bon
            il restera .htaccess et index.php : ce sont les seuls qui ne sont pas dans des dossiers
             -->