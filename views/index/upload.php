<h2>Upload image form:</h2>
<form action="<?php echo URL;?>index/image_upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    Description: <br>
    <input type="text" name="description"><br>
    <input type="submit" value="Upload Image" name="submit" id="upload-submit">
</form>
<?php
if(isset($this->msg)){
	echo $this->msg;
}
?>