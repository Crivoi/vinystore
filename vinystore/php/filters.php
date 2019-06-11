<div class = "filter-container">
    <!-- <ul class = "genre-menu">
        <li>    <span class = "genre-menu-span">Genres</span>   </li>
        <li>    <a href = "#" class = "genre-menu-item">House</a>   </li>
        <li>    <a href = "#" class = "genre-menu-item">Techno</a>  </li>
        <li>    <a href = "#" class = "genre-menu-item">Hip Hop</a> </li>
        <li>    <a href = "#" class = "genre-menu-item">Classic</a> </li>
    </ul> -->
    <!-- <hr> -->
    <ul class = "collection-menu">
        <li>    <span class = "collection-menu-span">Collection</span>  </li>
        <!-- <li>    <a href = "#" class = "collection-menu-item" id = "on-sale">On Sale</a>  </li> -->
        <li>    <a href = "/artists" class = "collection-menu-item">Artists</a> </li>
        <li>    <a href = "/labels" class = "collection-menu-item">Labels</a>    </li>
        <li>    <a href = "" class = "collection-menu-item">New</a>    </li>
    </ul>
    <hr>
    <form class = "form-search" action = "/php/search.controller.php" method = "POST">
        <a class = "search-btn">
            <img src = "/img/search.png" alt = "search_img" class = "search-img">
        </a>
        <input type = "text" class = "search-input" id = "search" name = "search" placeholder="Search...">
        <button type = "submit" name = "submit" value = "search-btn" class="search-btn">Search!</button>
        <h3>VinyStore: Buy, Sell, Exchange</h3>
    </form>
</div>
