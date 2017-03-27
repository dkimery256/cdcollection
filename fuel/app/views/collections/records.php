<!-- style -->
<style>
    table {
        border-collapse: collapse;
        width: 50%;
        text-align: center;
    }

    td {
        border: 1px solid darkgrey;
    }
    
</style>

<p class="lead">Your CD's:</p>
<?php 
if ($status == "new_user"){
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
        echo '<td colspan="2"><a class="btn btn-default" href="/collections/add_record/%s">Edit CD</a> <a class="btn btn-default" href="/collections/add_record/%s">Delete</a>';
        echo '<tr>';       
    }
   echo '</table><br><br>';
}
?>


