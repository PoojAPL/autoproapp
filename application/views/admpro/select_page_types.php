<?php if($page_type == 'HTML'){?>
<textarea class="form-control" name="Content"></textarea>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>
            CKEDITOR.replace( 'Content',{
              height: '300px',
            } );
</script>
<?php }else{ ?>
<textarea class="form-control" name="Content" style="width: 434px;"></textarea>
<?php } ?>
