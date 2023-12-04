<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" >
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form action=" " class="navbar-search">
                            <div class="input-group">
                                <input type="text" name="search" id="autocomplete" type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" value="Search">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/'); ?>img/boy.png" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/ubah_sandi'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('Element/logout'); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Topbar -->
        <script>
    function searchData() {
        var input = document.getElementById("autocomplete").value.toLowerCase();
        var items = document.getElementsByClassName("searchable-item");

        for (var i = 0; i < items.length; i++) {
            var itemText = items[i].textContent.toLowerCase();

            if (itemText.includes(input)) {
                items[i].style.display = "block";
            } else {
                items[i].style.display = "none";
            }
        }

        // Mendapatkan URL saat ini
        var url = new URL(window.location.href);

        // Menambahkan parameter pencarian ke URL
        url.searchParams.set("search", input);

        // Mengubah URL dengan parameter pencarian
        window.history.replaceState(null, null, url.toString());
    }

    // Fungsi untuk memeriksa apakah ada nilai pencarian dalam URL saat halaman dimuat
    function checkPreviousSearch() {
        var urlParams = new URLSearchParams(window.location.search);
        var previousSearch = urlParams.get("search");

        if (previousSearch) {
            document.getElementById("autocomplete").value = previousSearch;
            searchData();
        }
    }

    // Panggil fungsi checkPreviousSearch saat halaman dimuat
    window.onload = checkPreviousSearch;
</script>