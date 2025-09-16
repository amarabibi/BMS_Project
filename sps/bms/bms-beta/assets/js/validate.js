// --- General Validation Functions ---
function isRequired(value) {
  return value.trim() !== "";
}
function isValidEmail(value) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
}
function isValidNumber(value, min = null, max = null) {
  if (value === "" || isNaN(value)) return false;
  let num = parseFloat(value);
  if (min !== null && num < min) return false;
  if (max !== null && num > max) return false;
  return true;
}
function isValidName(value) {
  return /^[A-Za-z\s.'-]{2,100}$/.test(value);
}
function isValidSession(value) {
  return /^\d{4}(-\d{4})?$/.test(value); // 2020 or 2020-2024
}
function isValidCode(value) {
  return /^[A-Za-z0-9_-]{2,20}$/.test(value);
}
function isValidURL(value) {
  try {
    new URL(value);
    return true;
  } catch (_) {
    return false;
  }
}
function isValidDescription(value, min = 10, max = 500) {
  return value.length >= min && value.length <= max;
}

// --- Show Errors ---
function showErrors(errors, container) {
  container.innerHTML = `
        <div class="alert alert-danger">
            <ul class="mb-0">${errors.map((e) => `<li>${e}</li>`).join("")}</ul>
        </div>`;
}
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function (e) {
      let errors = [];
      let errorBox = this.querySelector(".errorBox");

      this.querySelectorAll("input, textarea, select").forEach((field) => {
        let name = field.name;
        let value = field.value.trim();

        // --- Universal Rules by Type or Name ---
        if (field.hasAttribute("required") && !isRequired(value)) {
          errors.push(`${name} is required.`);
        }
        if (field.type === "email" && value && !isValidEmail(value)) {
          errors.push(`${name} must be a valid email.`);
        }
        if (
          name.toLowerCase().includes("name") &&
          value &&
          !isValidName(value)
        ) {
          errors.push(`${name} must contain only letters.`);
        }
        if (
          name.toLowerCase().includes("year") &&
          value &&
          !isValidNumber(value, 1900, new Date().getFullYear())
        ) {
          errors.push(`${name} must be a valid year.`);
        }
        if (
          name.toLowerCase().includes("session") &&
          value &&
          !isValidSession(value)
        ) {
          errors.push(`${name} must be a valid session (e.g., 2020-2024).`);
        }
        if (
          name.toLowerCase().includes("code") &&
          value &&
          !isValidCode(value)
        ) {
          errors.push(`${name} must be 2–20 alphanumeric characters.`);
        }
        if (name.toLowerCase().includes("url") && value && !isValidURL(value)) {
          errors.push(`${name} must be a valid URL.`);
        }
        if (
          name.toLowerCase().includes("description") &&
          value &&
          !isValidDescription(value)
        ) {
          errors.push(`${name} must be 10–500 characters.`);
        }
      });

      // --- Stop form if errors ---
      if (errors.length > 0) {
        e.preventDefault();
        if (errorBox) {
          showErrors(errors, errorBox);
        } else {
          alert(errors.join("\n")); // fallback if no .errorBox
        }
      }
    });
  });
});
