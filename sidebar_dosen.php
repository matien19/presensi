          <li class="nav-item">
            <a href="../dosen_backend_dasbor" class="nav-link <?php if($hal == 'dasbor') { echo 'active';}?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../dosen_backend_klsmatkul" class="nav-link <?php if($hal == 'klsmatkul') { echo 'active';}?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Kelas Mata Kuliah
              </p>
            </a>
          </li>
        <li class="nav-item">
          <a href="../dosen_backend_laporan" class="nav-link <?php if ($hal == 'laporan') { echo 'active'; } ?>">
            <i class="nav-icon fas fa-chart-line "></i>
            <p>
            Grafik Presensi
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