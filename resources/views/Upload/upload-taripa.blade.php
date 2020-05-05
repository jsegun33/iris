
  <!------------Jane Code---Upload Clients--------------------->
   <div class="container">
    <form action="{{route('SubmitUploadRecordTaripa')}}" method="post" enctype="multipart/form-data">
      @csrf
     @method('PATCH')
     
      <input type="file" name="ClientsRecord">

      <input type="submit" value="upload">
    </form>
  </div>