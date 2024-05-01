<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href=" assets/css/nav.css">
  <link rel="stylesheet" href=" assets/css/index.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="website icon" href="assets/images/logo.png" type="png">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  </head>
<body>
<header id="nav-menu1" aria-label="navigation bar">
  <div class="container1">
    <div class="nav-start1">
      <a class="logo1" id="disable" href="index.php">
        <h1>ANK</h1>
      </a>
      <nav class="menu1" id="menu1">
        <ul class="menu-bar1">
          <li>
            <a href="" id="hamburger-close" aria-label="hamburger-close" aria-haspopup="true" aria-expanded="false">
            <i class='bx bx-x'></i>
            </a>
          </li>
          <li><a class="nav-link1" id="disable" href="index.php">ખરીદી</a></li>
          <!-- <li>
            <button class="nav-link1 dropdown-btn1" id="disable-dp" data-dropdown="dropdown2" aria-haspopup="true" aria-expanded="false" aria-label="discover">
              View
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown2" class="dropdown1">
              <ul role="menu">
                <li>
                  <span class="dropdown-link-title">Details</span>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link1" href="viewUserDetails.php">Users</a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link1" href="viewContactusDetails.php">Contact</a>
                </li>
              </ul>
            </div>
          </li> -->
          <!-- <li><a class="nav-link1" id="disable" href="sales.php">વેચાણ</a></li> -->
          <li><a class="nav-link1" id="disable" href="item.php">આઈટેમ</a></li>
          <li><a class="nav-link1" id="disable" href="selectname.php">ચિઠ્ઠી</a></li>
          <li><a class="nav-link1" id="disable" href="income.php">મડેલ રૂપિયા</a></li>
          <li><a class="nav-link1" id="disable" href="inout.php">રૂપિયા</a></li>
          <li><a class="nav-link1" id="disable" href="viewPendingPayment.php">ઉધાર</a></li>
        </ul>
      </nav>
    </div>

    <div class="nav-end1">
      <div class="right-container1">
        <a class="btn1" id="disable" href="login.php" title="Log Out"><i class='bx bx-log-out'></i></a>
      </div>
      <button id="hamburger1" aria-label="hamburger" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-menu" aria-hidden="true"></i>
      </button>
    </div>
  </div>
</header>

<script>
const dropdownBtn = document.querySelectorAll(".dropdown-btn1");
const dropdown = document.querySelectorAll(".dropdown1");
const hamburgerBtn = document.getElementById("hamburger1");
const hamburgercls = document.getElementById("hamburger-close");
const navMenu = document.querySelector(".menu1");
const links = document.querySelectorAll(".dropdown1 a");

function setAriaExpandedFalse() {
  dropdownBtn.forEach((btn) => btn.setAttribute("aria-expanded", "false"));
}

function closeDropdownMenu() {
  dropdown.forEach((drop) => {
    drop.classList.remove("active");
    drop.addEventListener("click", (e) => e.stopPropagation());
  });
}

function toggleHamburger() {
  navMenu.classList.toggle("show");
}

dropdownBtn.forEach((btn) => {
  btn.addEventListener("click", function (e) {
    const dropdownIndex = e.currentTarget.dataset.dropdown;
    const dropdownElement = document.getElementById(dropdownIndex);

    dropdownElement.classList.toggle("active");
    dropdown.forEach((drop) => {
      if (drop.id !== btn.dataset["dropdown"]) {
        drop.classList.remove("active");
      }
    });
    e.stopPropagation();
    btn.setAttribute(
      "aria-expanded",
      btn.getAttribute("aria-expanded") === "false" ? "true" : "false"
    );
  });
});

links.forEach((link) =>
  link.addEventListener("click", () => {
    closeDropdownMenu();
    setAriaExpandedFalse();
    toggleHamburger();
  })
);
document.documentElement.addEventListener("click", () => {
  closeDropdownMenu();
  setAriaExpandedFalse();
});
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeDropdownMenu();
    setAriaExpandedFalse();
  }
});
hamburgerBtn.addEventListener("click", toggleHamburger);

</script>