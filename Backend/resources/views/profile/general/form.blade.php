<!-- Form -->
<form action="{{ route('users.profile.update') }}" method="post" enctype="multipart/form-data">
@csrf

  @include( 'template-parts.user.form' )

</form>
<!-- End Form -->

@include( 'template-parts.editor' )
