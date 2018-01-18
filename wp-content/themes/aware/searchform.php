<!--Searchbox-->
        <form method="get" id="searchbox" action="<?php echo home_url(); ?>/">
            <fieldset>
                <input type="text" name="s" id="s" value="<?php _e("<!--:es-->Clique Enter para buscar<!--:--><!--:pb-->Clique Enter para buscar<!--:-->", 'framework'); ?>..." onfocus="if(this.value=='<?php _e("<!--:es-->Enter para pesquisarE<!--:--><!--:pb-->Enter para pesquisar<!--:-->", 'framework'); ?>...')this.value='';" onblur="if(this.value=='')this.value='<?php _e("<!--:es-->Enter para pesquisarE<!--:--><!--:pb-->Enter para pesquisar<!--:-->", 'framework'); ?>...';"/>
            </fieldset>
        </form>
<!--Searchbox-->