<!-- form group -->
<div class="form-group">
  <label for="excerpt">
    {{ __( 'Отрывок' ) }}
  </label>
  {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['class' => 'form-control', 'id'=>'excerpt', 'rows' => 7]) !!}
</div>
<!-- end form group -->

<!-- form group -->
<div class="form-group">
  <label for="description">
    {{ __( 'Текст' ) }}
  </label>
  {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
</div>
<!-- end form group -->
