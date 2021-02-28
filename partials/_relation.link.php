<?php if (relation_link_to_display($_GET['id']) == CANCEL_RELATION_LINK): ?>
    <div class="pull-right">
        <p>Vous avez déjà envoyé une demande d'amitié cet utilisateur</p>
        <a href="delete.friend.php?id=<?= $_GET['id']; ?>"
           class="btn btn-danger pull-right">
            <i class="fas fa-times"></i> Annuler la demande
        </a>
    </div>
<?php elseif (relation_link_to_display($_GET['id']) == ACCEPT_REJECT_RELATION_LINK): ?>
    <div class="pull-right">
        <p>Cet utilisateur vous a envoyé une demande d'amitié</p>
        <a href="accept.friend.php?id=<?= $_GET['id']; ?>"
           class="btn btn-success">
            <i class="fas fa-check"></i> Accepter
        </a>
        &nbsp;
        <a href="delete.friend.php?id=<?= $_GET['id']; ?>"
           class="btn btn-danger">
            <i class="fas fa-times"></i> Décliner
        </a>
    </div>
<?php elseif (relation_link_to_display($_GET['id']) == DELETE_RELATION_LINK): ?>
    <div class="pull-right">
        <p>Vous êtes déjà amis avec cet utilisateur</p>
        <a href="delete.friend.php?id=<?= $_GET['id']; ?>"
           class="btn btn-danger pull-right">
            <i class="fas fa-times"></i> Retirer de ma liste d'amis
        </a>
    </div>
<?php elseif (relation_link_to_display($_GET['id']) == ADD_RELATION_LINK): ?>
    <div class="pull-right">
        <p>Vous n'êtes pas encore amis avec cet utilisateur</p>
        <a href="add.friend.php?id=<?= $_GET['id']; ?>"
           class="btn btn-primary pull-right">
            <i class="fas fa-plus"></i> Envoyer une demande d'amitié
        </a>
    </div>
<?php endif; ?>