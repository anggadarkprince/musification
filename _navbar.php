<div class="navigation-container">
    <nav class="navigation-bar">
        <a href="index.php" class="ajax-link logo">
            <img src="assets/images/player/play-white.png" alt="Logo">Musification
        </a>
        <div class="menu-group">
            <div class="nav-item">
                <a href="search.php" class="nav-item-link search-link ajax-link">
                    Search the music <img src="assets/images/player/search.png" alt="Search">
                </a>
            </div>
        </div>
        <div class="menu-group">
            <div class="nav-title">LIBRARY</div>
            <div class="nav-item<?= preg_match('/index.php/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                <a href="index.php" class="nav-item-link ajax-link">Browse</a>
            </div>
            <div class="nav-item nav-your-music<?= preg_match('/your_music.php/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                <a href="your_music.php" class="nav-item-link ajax-link">Your Music</a>
            </div>
            <div class="nav-item<?= preg_match('/recent.php/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                <a href="recent.php" class="nav-item-link ajax-link">Recently Played</a>
            </div>
            <div class="nav-item<?= preg_match('/local.php/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                <a href="local.php" class="nav-item-link ajax-link">Local Files</a>
            </div>
        </div>
        <div class="menu-group playlist-group">
            <div class="nav-title">PLAYLIST</div>
            <?php
            $playlistObj = new \App\Playlist();
            $playlists = $playlistObj->getUserPlaylists($session->getData('auth.id'));
            $playlistPage = isset($playlist) ? $playlist['id'] : '';
            ?>
            <?php foreach ($playlists as $playlist): ?>
                <div class="nav-item nav-playlist<?= $playlistPage ==  $playlist['id'] ? ' active' : '' ?>" data-id="<?= $playlist['id'] ?>">
                    <a href="playlist.php?id=<?= $playlist['id'] ?>" class="nav-item-link ajax-link">
                        <?= $playlist['title'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="nav-item create-playlist">
                <a href="javascript:void(0)" data-modal="#modal-playlist" class="nav-item-link btn-new-playlist">
                    <strong>New Playlist +</strong>
                </a>
            </div>
        </div>
        <div class="menu-group playlist-group">
            <div class="nav-title">SETTING</div>
            <div class="nav-item<?= preg_match('/account.php/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                <a href="account.php" class="nav-item-link ajax-link">Account</a>
            </div>
            <div class="nav-item">
                <a href="actions/logout.php" class="nav-item-link">Logout</a>
            </div>
        </div>
    </nav>
</div>