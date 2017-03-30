<!-- style -->
<style>
    table {
        border-collapse: collapse;
        width: 80%;
        text-align: center;                
    }

    td {
        border: 2px solid darkgrey;
        padding: .5%;
    }
    
</style>

<p class="lead">Your CD's:</p>
<?php 
if ($status == "new_user" || $albums == null){
    echo '<p>You do not have any CDs saved.  Please add some Albums to your profile</p>';
    echo sprintf('<a class="btn btn-default" href="/collections/add_record/%s">Add CD</a><br><br>', $status);
}else{    
    echo sprintf('<a class="btn btn-default" href="/collections/add_record/%s">Add CD</a><br><br>', $status);
    echo '<table>';
    echo '<th>Artist</th>';
    echo '<th>Album</th>';
    echo '<th>Release Year</th>';
    echo '<th>Record Label</th>';
    foreach ($albums as $album){
        echo '<tr>';
        echo '<td>' . $album->artist . '</td>';
        echo '<td>' . $album->album . '</td>';
        echo '<td>' . $album->release_year . '</td>';
        echo '<td>' . $album->label . '</td>';
        echo sprintf('<td colspan="2" style="text-align: right;"><a class="btn btn-default" href="/collections/edit_record/%s">Edit CD</a>', $album->id);
        echo sprintf('&nbsp&nbsp<a class="btn btn-danger" href="/collections/add_record/%s">Delete</a></td>', $album->id);
        echo '<tr>';       
    }
   echo '</table><br><br>';
}
?>


