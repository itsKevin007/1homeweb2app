let currentStep = 1;
const totalSteps = 4;

function updateProgress() {
  // Update progress steps
  document.querySelectorAll(".step").forEach((step, index) => {
    const stepNumber = index + 1;
    if (stepNumber < currentStep) {
      step.classList.add("completed");
      step.classList.remove("active");
    } else if (stepNumber === currentStep) {
      step.classList.add("active");
      step.classList.remove("completed");
    } else {
      step.classList.remove("active", "completed");
    }
  });

  // Update content panels
  document.querySelectorAll(".step-panel").forEach((panel) => {
    panel.classList.remove("active");
    if (parseInt(panel.dataset.step) === currentStep) {
      panel.classList.add("active");
    }
  });

  // Update buttons
  document.getElementById("prevBtn").disabled = currentStep === 1;
  const nextBtn = document.getElementById("nextBtn");

  if (currentStep === totalSteps) {
    nextBtn.innerHTML = ``;
  } else {
    nextBtn.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 6L15 12L9 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`;
  }
}

function nextStep() {
  if (currentStep < totalSteps) {
    currentStep++;
    updateProgress();
  } else {
    alert("Form submitted successfully!");
    // Add form submission logic here
  }
}

function previousStep() {
  if (currentStep > 1) {
    currentStep--;
    updateProgress();
  }
}

// Optional: Add click handlers for steps
document.querySelectorAll(".step").forEach((step) => {
  step.addEventListener("click", () => {
    const stepNumber = parseInt(step.dataset.step);
    if (stepNumber < currentStep) {
      currentStep = stepNumber;
      updateProgress();
    }
  });
});


