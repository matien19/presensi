
          <li class="nav-item">
            <a href="../mhs_backend_dasbor" class="nav-link <?php if ($hal=='dasbor'){echo 'active';}?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../mhs_backend_presensi" class="nav-link <?php if ($hal=='presensi'){echo 'active';}?>">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Presensi
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="../ganti_pw" class="nav-link <?php if ($hal == 'gantipassword') { echo 'active'; } ?>">
            <i class="nav-icon fas fa-lock "></i>
            <p>
            Ganti Password
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../auth/logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt "></i>
            <p>
            Keluar
            </p>
          </a>
        </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>