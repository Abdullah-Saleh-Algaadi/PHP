const signupForm = document.getElementById("signup-form");
const loginForm = document.getElementById("login-form");
const updateForm = document.getElementById("update-form");
const insertForm = document.getElementById("insert-form");
const deleteForm = document.getElementById("delete-form");
const searchForm = document.getElementById("search-form");
const userManagementForm = document.getElementById("user-management-form");
const searchByEmailForm = document.getElementById("search-by-user-email");

const addError = (input, message) => {
  input.classList.add("error-message");
  input.placeholder = message;
};

const removeError = (input, placeholder) => {
  input.classList.remove("error-message");
  input.placeholder = placeholder;
};

if (signupForm) {
  signupForm.addEventListener("submit", (event) => {
    let isValid = true;

    const username = document.getElementById("username");
    const signupEmail = document.getElementById("signupEmail");
    const signupPassword = document.getElementById("signupPassword");

    if (username.value.trim() === "" || username.value.trim() === null) {
      addError(username, "Username is required");
      isValid = false;
    } else {
      removeError(username, "User name");
    }

    if (signupEmail.value.trim() === "" || signupEmail.value.trim() === null) {
      addError(signupEmail, "Email is required");
      isValid = false;
    } else {
      removeError(signupEmail, "Email");
    }

    if (
      signupPassword.value.trim() === "" ||
      signupPassword.value.trim() === null
    ) {
      addError(signupPassword, "Password is required");
      isValid = false;
    } else {
      removeError(signupPassword, "Password");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
}

if (loginForm) {
  loginForm.addEventListener("submit", (event) => {
    let isValid = true;

    const loginEmail = document.getElementById("loginEmail");
    const loginPassword = document.getElementById("loginPassword");

    if (loginEmail.value.trim() === "" || loginEmail.value.trim() === null) {
      addError(loginEmail, "Email is required");
      isValid = false;
    } else {
      removeError(loginEmail, "Enter email");
    }

    if (
      loginPassword.value.trim() === "" ||
      loginPassword.value.trim() === null
    ) {
      addError(loginPassword, "Password is required");
      isValid = false;
    } else {
      removeError(loginPassword, "Enter password");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
}

if (updateForm) {
  updateForm.addEventListener("submit", (event) => {
    const Product_name = document.getElementById("update_Product_name");
    const product_description = document.getElementById(
      "update_product_description"
    );
    const Product_price = document.getElementById("update_Product_price");
    const Product_picture = document.getElementById("Product_picture");

    let isValid = true;

    if (
      Product_name.value.trim() === "" ||
      Product_name.value.trim() === null
    ) {
      addError(Product_name, "Product name is required");
      isValid = false;
    } else {
      removeError(Product_name, "Enter Product name");
    }

    if (
      product_description.value.trim() === "" ||
      product_description.value.trim() === null
    ) {
      addError(product_description, "Product description is required");
      isValid = false;
    } else {
      removeError(product_description, "Enter Product description");
    }

    if (
      Product_price.value.trim() === "" ||
      Product_price.value.trim() === null
    ) {
      addError(Product_price, "Product price is required");
      isValid = false;
    } else {
      removeError(Product_price, "Enter Product price");
    }

    console.log("I am clicked ");

    if (!isValid) {
      event.preventDefault();
    }
  });
}

if (insertForm) {
  insertForm.addEventListener("submit", (event) => {
    const product_name = document.getElementById("insert_product_name");
    const product_description = document.getElementById(
      "insert_Product_description"
    );
    const product_price = document.getElementById("insert_Product_price");
    const product_picture = document.getElementById("insert_Product_picture");

    let isValid = true;

    if (
      product_name.value.trim() === "" ||
      product_name.value.trim() === null
    ) {
      addError(product_name, "Product name is required");
      isValid = false;
    } else {
      removeError(product_name, "Enter product name");
    }

    if (
      product_description.value.trim() === "" ||
      product_description.value.trim() === null
    ) {
      addError(product_description, "Product description is required");
      isValid = false;
    } else {
      removeError(product_description, "Enter product description");
    }

    if (
      product_price.value.trim() === "" ||
      product_price.value.trim() === null
    ) {
      addError(product_price, "Product price is required");
      isValid = false;
    } else {
      removeError(product_price, "Enter product price");
    }

    if (product_picture.files.length === 0) {
      addError(product_picture, "Product picture is required");
      isValid = false;
    } else {
      removeError(product_picture, "Enter product picture");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
}
if (searchForm) {
  searchForm.addEventListener("submit", (event) => {
    let isValid = true;
    const searchQuery = document.querySelector('input[name="query"]');
    if (searchQuery.value.trim() === "" || searchQuery.value.trim() === null) {
      addError(searchQuery, "Enter search query");
      isValid = false;
    } else {
      removeError(searchQuery, "Search...");
    }
    if (!isValid) {
      event.preventDefault();
    }
  });
}

if (userManagementForm) {
  userManagementForm.addEventListener("submit", (event) => {
    const userEmail = document.getElementById("user-email");
    const userName = document.getElementById("user-name");
    const userType = document.getElementById("user-type");

    let isValid = true;

    if (userEmail.value.trim() === "" || userEmail.value.trim() === null) {
      addError(userEmail, "Email is required");
      isValid = false;
    } else {
      removeError(userEmail, "Enter email");
    }

    if (userName.value.trim() === "" || userName.value.trim() === null) {
      addError(userName, "Name is required");
      isValid = false;
    } else {
      removeError(userName, "Enter name");
    }

    if (userType.value.trim() === "" || userType.value.trim() === null) {
      addError(userType, "User type is required");
      isValid = false;
    } else if (
      userType.value.trim() !== "admin" &&
      userType.value.trim() !== "customer"
    ) {
      userType.value = "";
      addError(userType, "User type should be admin or customer");
      isValid = false;
    } else {
      removeError(userType, "Enter user type");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
}

if (searchByEmailForm) {
  searchByEmailForm.addEventListener("submit", (event) => {
    const userEmail = document.getElementById("user-Email");

    let isValid = true;

    if (userEmail.value.trim() === "" || userEmail.value.trim() === null) {
      addError(userEmail, "Email is required");
      isValid = false;
    } else {
      removeError(userEmail, "Enter email");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
}
