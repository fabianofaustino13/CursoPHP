<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item <?=$active=='produto' ? 'active' : '';?>">
            <a class="nav-link" href="/loja/produto/">Produto</a>
        </li>
        <li class="nav-item <?=$active=='marca' ? 'active' : '';?>">
            <a class="nav-link" href="/loja/marca/">Marca</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/loja/logout.php">Logout</a>
        </li>
    </ul>
    <span class="navbar-text">
        <a class="nav-link" href="/loja/logout.php">Logout</a>
    </span>
</nav>