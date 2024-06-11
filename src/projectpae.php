<?php
include 'layout/header.php';
require 'config.php';

$projectManager = new ProjectManager($conn);
$projectId = intval($_GET['id']); // replace with your project ID
$project = $projectManager->read($projectId);

$commentManager = new CommentManager($conn);
$userManager = new UserManager($conn);
$comments = $commentManager->list();

echo "<h1>" . $project->getName() . "</h1>";
echo "<p>" . $project->getDescription() . "</p>";
echo "<p>State: " . ($project->getState() == 1 ? "Free" : "Taken") . "</p>";
echo "<p>Creation date: " . $project->getCreationDate()->format('Y-m-d H:i:s') . "</p>";
echo "<p>Author: " . $userManager->getUserById($project->getIdAuthor())['name'] . "</p>";
echo "<p>Repo Git: <a href='" . $project->getRepoGit() . "'>" . $project->getRepoGit() . "</a></p>";
echo "<img src='" . $project->getThumbnail() . "' alt='Thumbnail'>";

echo "<h2>Comments</h2>";
echo '<div class="container">
    <h2>Create Comment</h2>
    <form action="createcomment.php" method="post">
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4" required></textarea>
            <input type="hidden" name="projectId" value='. $projectId . '>
        </div>
        <div>
            <button type="submit">Create Comment</button>
        </div>
    </form>
</div>';

foreach ($comments as $comment) {
    if ($comment->getIdProject() != $project->getId()) {
        continue;
    } else {
        $authorName = $userManager->getUserById($comment->getIdAuthor())['name'];
        echo "<div>";
        echo "<p>Author: $authorName</p>";
        echo "<p>Creation date: " . $comment->getCreationDate()->format('Y-m-d H:i:s') . "</p>";
        echo "<p>Content: " . htmlspecialchars($comment->getContent()) . "</p>";
        echo "<div class='buttons'>";
        echo "<div class='action_btn'>";
        echo '<button  onclick="editComment(' . $comment->getId() . ', \'' . htmlspecialchars($comment->getContent()) . '\')">Edit</button>';
        echo '<button class="delete" onclick="confirmDelete(' . $comment->getId() . ')">Delete</button>';
        echo "</div>";
        echo "</div>";
    
    }
}
?>

<!-- Modal for editing comments -->
<div id="editModal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form id="editForm" action="editcomment.php" method="post">
            <label for="editContent">Edit Content:</label>
            <textarea id="editContent" name="content" rows="4" required></textarea>
            <input type="hidden" name="commentId" id="editCommentId">
            <button type="submit">Update Comment</button>
        </form>
    </div>
</div>

<!-- Confirmation dialog for deleting comments -->
<div id="deleteConfirm" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Are you sure you want to delete this comment?</p>
        <form id="deleteForm" action="deletecomment.php" method="post">
            <input type="hidden" name="commentId" id="deleteCommentId">
            <button  type="submit">Delete</button>
            <button type="button" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

<script>
function editComment(id, content) {
    document.getElementById('editContent').value = content;
    document.getElementById('editCommentId').value = id;
    document.getElementById('editModal').style.display = 'block';
}

function confirmDelete(id) {
    document.getElementById('deleteCommentId').value = id;
    document.getElementById('deleteConfirm').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
    document.getElementById('deleteConfirm').style.display = 'none';
}
</script>

