t301.ready(function(){
        const tab = t301.classes('.t-tab');
        const activetab = window.location.hash;
        if(activetab){
            t301.query('a.t-tab.t-active-tab').classList.remove('t-active-tab');
            t301.query('.t-tabs.t-show').classList.add('t-hide');
            t301.query('.t-tabs.t-hide.t-show').classList.remove('t-show');

            t301.query('a[href="'+activetab+'"]').classList.add('t-active-tab');
            t301.id(activetab).classList.add('t-show');
            t301.id(activetab).classList.remove('t-hide');
        }
        for(let i =0; i < tab.length; i++){
            tab[i].onclick = function(e){
                e.preventDefault();
                t301.query('a.t-tab.t-active-tab').classList.remove('t-active-tab');
                t301.query('.t-tabs.t-show').classList.add('t-hide');
                t301.query('.t-tabs.t-hide.t-show').classList.remove('t-show');

                this.classList.add('t-active-tab');
                if(t301.id(this.getAttribute('href'))){
                    t301.id(this.getAttribute('href')).classList.add('t-show');
                    t301.id(this.getAttribute('href')).classList.remove('t-hide');
                }
                if(t301.query('.t-message-box')){
                    t301.query('.t-message-box').remove();
                }
            }
        }
        if(t301.id('add_class')){
            if(t301.id('add_class').checked){
                t301.id('default_class').parentNode.style.display='flex';
            }
            else{
                t301.id('default_class').parentNode.style.display='none';
            }
            t301.id('add_class').addEventListener('change', function(event){
                if (event.target.checked){
                    t301.id('default_class').parentNode.style.display='flex';
                }
                else{
                    t301.id('default_class').parentNode.style.display='none';
                }
            });
        }
        if(t301.id('default_class')){
            t301.id('default_class').value = t301.id('default_class').value.replace(/[^a-z0-9-_\s]/gmi, '');
            t301.id('default_class').value = t301.id('default_class').value.replace(/\s\s+/g, ' ');
            t301.id('default_class').addEventListener('input', function(event){
                t301.id('default_class').value = this.value.replace(/[^a-z0-9-_\s]/gmi, '');
                t301.id('default_class').value = this.value.replace(/\s\s+/g, ' ');
            });
        }
    }
);
