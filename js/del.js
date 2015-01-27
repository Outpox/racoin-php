/**
 * Created by ponicorn on 27/01/15.
 */
$("form").submit(function(event){
    if(!confirm("Êtes-vous sûre de vouloir supprimer l'annonce?")){
        event.preventDefault();
    }
});
