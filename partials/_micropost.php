<article class="media status-media" id="micropost<?= $micropost->m_id ?>">
    <div class="pull-left">
        <img src="<?= $micropost->avatar ?: get_avatar_url($micropost->email); ?>"
             alt="Image de profile de <?= e($micropost->pseudo); ?>"
             class="media-object avatar-xs">
    </div>
    <div class="media-body">
        <h4 class="media-heading"> <?= e($micropost->pseudo); ?></h4>

        <p>
            <i class="far fa-clock"></i>
            &nbsp;
            <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span>
            <?php if ($micropost->user_id == get_session('user_id')): ?>
                <a data-confirm="Voulez-vous vraiment supprimer cette publication ?"
                   href="delete.micropost.php?id=<?= $micropost->m_id ?>">
                    <i class="fas fa-trash"></i> Supprimer
                </a>
            <?php endif; ?>
        </p>
        <?= nl2br(replace_links(e($micropost->content))); ?>
        <hr>
        <p>
            <?php if (micropost_has_already_been_liked($micropost->m_id)): ?>
                <a id="unlike<?= $micropost->m_id ?>" data-action="unlike" class="like"
                   href="micropost.unlike.php?id=<?= $micropost->m_id ?>">
                    <i class="fas fa-thumbs-down"></i> Je n'aime pas
                </a>
            <?php else: ?>
                <a id="like<?= $micropost->m_id ?>" data-action="like" class="like"
                   href="micropost.like.php?id=<?= $micropost->m_id ?>">
                    <i class="fas fa-thumbs-up"></i> J'aime
                </a>
            <?php endif; ?>
        </p>
        <div id="likers_<?=$micropost->m_id?>">
            <?= get_likers_text($micropost->m_id); ?>
        </div>
    </div>
</article>