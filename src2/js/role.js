if(document.querySelector('#switch-orange')!=null){
    document.querySelector('#switch-orange').onclick = function(){
        if(this.checked==true){
            $.ajax({
                type: 'POST',
                url: '/wp-content/themes/Yana/core/ajax/roleAjax.php',
                data: {action:'specialist'},
            }).done(function (mes) {
                if(document.querySelector('.sign-up-parent')!=null && document.querySelector('.sign-up-doctor')!=null){
                    document.querySelector('.sign-up-parent').style.display = 'none';
                    document.querySelector('.sign-up-doctor').style.display = 'block';
                }
            }).fail( function (x, y, z) {
            });
        }
        if(this.checked==false){
            $.ajax({
                type: 'POST',
                url: '/wp-content/themes/Yana/core/ajax/roleAjax.php',
                data: {action:'parent'},
            }).done(function (mes) {
                if(document.querySelector('.sign-up-parent')!=null && document.querySelector('.sign-up-doctor')!=null){
                    document.querySelector('.sign-up-parent').style.display = 'block';
                    document.querySelector('.sign-up-doctor').style.display = 'none';
                }
            }).fail( function (x, y, z) {
            });
        }
    }
}