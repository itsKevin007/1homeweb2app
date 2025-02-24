 <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/categories.css">
 <link href="<?php echo WEB_ROOT; ?>style/searchSuggestions.css" rel="stylesheet">
 <!-- for wizard modal for booking -->
 <style>
     .wizard-container {
         margin-top: 50px;
     }

     .wizard-step {
         padding: 20px;
         border-radius: 5px;
         display: none;
     }

     .wizard-step.active {
         display: block;
     }

     .step-indicator {
         display: flex;
         justify-content: space-between;
         margin-bottom: 30px;
         position: relative;
     }

     .step-indicator::before {
         content: '';
         position: absolute;
         top: 24px;
         left: 0;
         width: 100%;
         height: 3px;
         background-color: #e0e0e0;
         z-index: 0;
     }

     .step {
         text-align: center;
         z-index: 1;
         position: relative;
         width: 33.333%;
     }

     .step-circle {
         width: 50px;
         height: 50px;
         border-radius: 50%;
         background-color: #e0e0e0;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 0 auto 10px;
         font-weight: bold;
         color: #fff;
         transition: background-color 0.3s;
         position: relative;
         z-index: 2;
     }

     /* Line between steps */
     .step-line {
         position: absolute;
         height: 3px;
         top: 24px;
         width: 100%;
         left: -50%;
         z-index: 1;
     }

     .step:first-child .step-line {
         display: none;
     }

     .step.active .step-line,
     .step.completed .step-line {
         background-color: #022c5c;
     }

     .step.completed .step-line {
         background-color: #022c5c;
     }

     .step.completed .step-circle,
     .step.active .step-circle {
         background-color: #022c5c;
     }

     .step.completed .step-circle {
         background-color: #022c5c;
     }

     .navigation-buttons {
         margin-top: 20px;
         display: flex;
         justify-content: space-between;
     }
 </style>
 <!-- end -->
 <!-- Company Section -->
 <div style="padding: 15px; margin-top: -20px;">
     <div class="serachbar-homepage2 mt-24" style="margin-bottom: 20px;">
         <div class="search-container" style="width: 100%;">
             <div class="search-input-wrapper">
                 <i class="fas fa-search search-icon"></i>
                 <input type="text" placeholder="Need to fix something?" id="searchInput">
                 <i class="fas fa-times clear-icon" id="clearSearch"></i>
             </div>
             <div class="suggestions-dropdown" id="suggestionsDropdown"></div>
         </div>
         <!-- Modal -->
         <div id="myModal" class="modal">
             <div class="modal-content">
                 <span class="close">&times;</span>
                 <h2 id="modalTitle"></h2>
                 <!-- Step Indicators with Lines -->
                 <div class="step-indicator">
                     <div class="step active" id="step-indicator-1">
                         <div class="step-line"></div>
                         <div class="step-circle">1</div>
                         <p>Personal Information</p>
                     </div>
                     <div class="step" id="step-indicator-2">
                         <div class="step-line"></div>
                         <div class="step-circle">2</div>
                         <p>Booking Date</p>
                     </div>
                     <div class="step" id="step-indicator-3">
                         <div class="step-line"></div>
                         <div class="step-circle">3</div>
                         <p>Review</p>
                     </div>
                 </div>

                 <!-- Step 1 Content -->
                 <div id="step1" class="wizard-step active">
                     <div class="mb-3">
                         <label>Select Address</label>
                         <select class="form-select" aria-label="Default select example" required>
                             <option value="" selected disabled style="width: 90%;" id="address">Select Location</option>
                             <?php
                                $sql = "SELECT * FROM tbl_location WHERE user_id = :user_id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                                $stmt->execute();
                                $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($locations as $location) {
                                    echo "<option value=\"{$location['name']}\">{$location['name']}</option>";
                                }
                                ?>
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="contactNumber" class="form-label">Contact Number</label>
                         <input type="text" id="contactNumber" placeholder="Optional" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="roomNumber" class="form-label">Room Number</label>
                         <input type="text" id="roomNumber" class="form-control" placeholder="Optional">
                     </div>
                 </div>

                 <!-- Step 2 Content -->
                 <div id="step2" class="wizard-step">

                     <div class="mb-3">
                         <label for="dateTime" class="form-label">Date and Time</label>
                         <input type="date" id="dateTime" class="form-control" placeholder="Enter the date and time">
                     </div>
                 </div>

                 <!-- Step 3 Content -->
                 <div id="step3" class="wizard-step">
                     <p>Please review your information before submitting:</p>
                     <div class="alert alert-info">
                         <form action="process.php?action=addBooking" method="POST" id="summaryInfo" class="mt-3">
                             <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                             <input type="hidden" name="requested_service" value="Service Title">
                             <div class="mb-3">
                                 <label for="summaryAddress" class="form-label"><strong>Address:</strong></label>
                                 <input type="text" name="booking_address" id="summaryAddress" class="form-control" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="summaryContact" class="form-label"><strong>Contact Number:</strong></label>
                                 <input type="text" name="contact_num" id="summaryContact" class="form-control" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="summaryRoomNumber" class="form-label"><strong>Room Number:</strong></label>
                                 <input type="text" name="roomNo" id="summaryRoomNumber" class="form-control" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="summaryDateTime" class="form-label"><strong>Date and Time:</strong></label>
                                 <input type="text" name="created_at" id="summaryDateTime" class="form-control" readonly>
                             </div>
                         </form>
                     </div>
                     <div class="form-check mt-3">
                         <input class="form-check-input" type="checkbox" id="termsCheck">
                         <label class="form-check-label" for="termsCheck">
                             I confirm all information is correct
                         </label>
                     </div>
                 </div>

                 <!-- Navigation Buttons -->
                 <div class="navigation-buttons">
                     <button id="prevBtn" class="btn btn-secondary" disabled>Previous</button>
                     <button id="nextBtn" class="btn btn-primary" style="background-color: #022c5c; border-color: #022c5c;">Next</button>
                     <button id="submitBtn" class="btn btn-success" onclick="document.getElementById('summaryInfo').submit()" style="display: none; background-color: #022c5c; border-color: #022c5c;">Submit</button>
                 </div>

                 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
                 <script>
                     document.addEventListener('DOMContentLoaded', function() {
                         const steps = document.querySelectorAll('.wizard-step');
                         const stepIndicators = document.querySelectorAll('.step');
                         const stepLines = document.querySelectorAll('.step-line');
                         const prevBtn = document.getElementById('prevBtn');
                         const nextBtn = document.getElementById('nextBtn');
                         const submitBtn = document.getElementById('submitBtn');

                         let currentStep = 0;

                         // Update UI based on current step
                         function updateUI() {
                             steps.forEach((step, index) => {
                                 step.classList.remove('active');
                                 stepIndicators[index].classList.remove('active', 'completed');

                                 if (index < currentStep) {
                                     stepIndicators[index].classList.add('completed');
                                 } else if (index === currentStep) {
                                     step.classList.add('active');
                                     stepIndicators[index].classList.add('active');
                                 }
                             });

                             // Update button states
                             prevBtn.disabled = currentStep === 0;

                             if (currentStep === steps.length - 1) {
                                 nextBtn.style.display = 'none';
                                 submitBtn.style.display = 'block';

                                 // Update summary information for review
                                 updateSummary();
                             } else {
                                 nextBtn.style.display = 'block';
                                 submitBtn.style.display = 'none';
                             }
                         }

                         function updateSummary() {
                             // For the address, get the selected option text
                             const addressSelect = document.querySelector('.form-select');
                             const selectedAddress = addressSelect.options[addressSelect.selectedIndex]?.text || '-';

                             // Set values to input fields (not textContent)
                             document.getElementById('summaryAddress').value = selectedAddress;
                             document.getElementById('summaryContact').value =
                                 document.getElementById('contactNumber').value || '-';
                             document.getElementById('summaryRoomNumber').value =
                                 document.getElementById('roomNumber').value || '-';
                             document.getElementById('summaryDateTime').value =
                                 document.getElementById('dateTime').value || '-';
                         }

                         // Next button handler
                         nextBtn.addEventListener('click', function() {
                             if (currentStep < steps.length - 1) {
                                 currentStep++;
                                 updateUI();
                             }
                         });

                         // Previous button handler
                         prevBtn.addEventListener('click', function() {
                             if (currentStep > 0) {
                                 currentStep--;
                                 updateUI();
                             }
                         });

                         // Submit button handler
                         submitBtn.addEventListener('click', function() {
                             if (document.getElementById('termsCheck').checked) {
                                 alert('Registration submitted successfully!');
                                 // Here you would typically send the data to your server
                             } else {
                                 alert('Please confirm your information is correct');
                             }
                         });
                     });
                 </script>
             </div>
         </div>

         <script>
             const searchInput = document.getElementById('searchInput');
             const clearSearch = document.getElementById('clearSearch');
             const suggestionsDropdown = document.getElementById('suggestionsDropdown');
             const modal = document.getElementById('myModal');
             const closeBtn = document.getElementsByClassName('close')[0];

             // Clear search input
             clearSearch.addEventListener('click', () => {
                 searchInput.value = '';
                 suggestionsDropdown.innerHTML = '';
                 suggestionsDropdown.classList.remove('show');
                 clearSearch.style.display = 'none';
             });

             // Handle input and focus events
             searchInput.addEventListener('input', debounce(handleSearch, 300));
             searchInput.addEventListener('focus', handleSearch);

             async function handleSearch(e) {
                 const searchTerm = searchInput.value.trim();

                 // Show/hide clear button
                 if (searchTerm) {
                     clearSearch.style.display = 'block';
                 } else {
                     clearSearch.style.display = 'none';
                 }

                 try {
                     // Replace with your actual API endpoint
                     const response = await fetch(`get_suggestions.php?search=${encodeURIComponent(searchTerm)}`);
                     const suggestions = await response.json();

                     suggestionsDropdown.innerHTML = '';

                     if (suggestions.length > 0) {
                         suggestions.forEach(item => {
                             const div = document.createElement('div');
                             div.className = 'suggestion-item';
                             div.innerHTML = `<strong>${highlightMatch(item.sub_categor, searchTerm)}</strong>`;
                             div.onclick = () => showModal(item);
                             suggestionsDropdown.appendChild(div);
                         });
                         suggestionsDropdown.classList.add('show');
                     } else if (searchTerm) {
                         // Show "no results" message
                         const noResults = document.createElement('div');
                         noResults.className = 'no-results';
                         noResults.innerHTML = `No results found for "<strong>${searchTerm}</strong>"`;
                         suggestionsDropdown.appendChild(noResults);
                         suggestionsDropdown.classList.add('show');
                     } else {
                         suggestionsDropdown.classList.remove('show');
                     }
                 } catch (error) {
                     console.error('Error fetching suggestions:', error);
                     suggestionsDropdown.classList.remove('show');
                 }
             }

             // Highlight matching text
             function highlightMatch(text, query) {
                 if (!query) return text;

                 const regex = new RegExp(query.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'gi');
                 return text.replace(regex, match => `<span style="color: var(--primary-color);">${match}</span>`);
             }

             // Debounce function to limit API calls
             function debounce(func, wait) {
                 let timeout;
                 return function(...args) {
                     clearTimeout(timeout);
                     timeout = setTimeout(() => func.apply(this, args), wait);
                 };
             }

             // Show modal with animation
             function showModal(item) {
                 document.getElementById('modalTitle').textContent = item.sub_categor;
                 modal.style.display = 'block';
                 setTimeout(() => modal.classList.add('show'), 10);
                 suggestionsDropdown.classList.remove('show');
             }

             // Close modal with animation
             function closeModal() {
                 modal.classList.remove('show');
                 setTimeout(() => modal.style.display = 'none', 300);
             }

             // Close handlers
             closeBtn.onclick = closeModal;
             window.onclick = function(event) {
                 if (event.target == modal) closeModal();
                 if (event.target != searchInput &&
                     !suggestionsDropdown.contains(event.target) &&
                     event.target != clearSearch) {
                     suggestionsDropdown.classList.remove('show');
                 }
             }

             // Add focus animation
             searchInput.addEventListener('focus', () => {
                 document.querySelector('.search-input-wrapper').style.boxShadow = '0 0 0 3px rgba(67, 97, 238, 0.3), var(--shadow)';
             });

             searchInput.addEventListener('blur', () => {
                 document.querySelector('.search-input-wrapper').style.boxShadow = 'var(--shadow)';
             });
         </script>
     </div>


     <!-- Companies Section -->
     <section class="category-section" style="width: 100%;">
         <div class="category-header">
             <h6 style="float: left;"><b>Companies</b></h6>
             <a href="#" style="float: right; color: grey;">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                 </svg>
             </a>
             <div style="clear: both;"></div>
         </div>
         <div class="scroll-container companies-container">
             <?php
                $sql = "SELECT * FROM tbl_company WHERE is_deleted = 0";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($companies) > 0) {
                    foreach ($companies as $company) {
                ?>
                     <a href="<?= WEB_ROOT . "client/categories/index.php?view=company_details&com_id=" . $company['com_id']; ?>" target="_self" class="company-card">
                         <img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" alt="Company" />
                         <p style="color: black;"><?= htmlspecialchars($company['bname']); ?></p>
                     </a>
             <?php
                    }
                } else {
                    echo '<div class="list-item"><p>No records found</p></div>';
                }
                ?>
         </div>

     </section>

     <!-- Main Categories Section -->
     <section class="category-section">
         <div class="category-header" style="margin-bottom: 5px;">
             <h6 style="float: left;"><b>Main Categories</b></h6>
             <a href="#" style="float: right; color: grey;">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                 </svg>
             </a>
             <div style="clear: both;"></div>
         </div>
         <div class="scroll-container ads-container">
             <?php
                // Fetch data from accepted_services table
                $sql = "SELECT * FROM ind_maincat WHERE is_deleted = 0";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $mainCategory = $stmt;
                ?>
             <?php
                if ($mainCategory->rowCount() > 0) {
                    foreach ($mainCategory as $row) {
                ?>
                     <a href="<?php echo WEB_ROOT; ?>client/categories/index.php?view=subcategories&sercatid=<?= $row['sercatid']; ?>" target="_self" class="ad-card">
                         <img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" alt="Ad 1" />
                         <div class="ad-content">
                             <h5><?= htmlspecialchars($row['main_cat']); ?></h5>
                             <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 20ch;"><?= htmlspecialchars($row['descript']); ?></p>
                         </div>
                     </a>
             <?php
                    }
                } else {
                    echo '<div class="list-item"><p>No records found</p></div>';
                }
                ?>
         </div>


     </section>

     <!-- Subcategories Section -->
     <section class="category-section">
         <div class="category-header">
             <h6 style="float: left;"><b>Services</b></h6>
             <a href="#" style="float: right; color: grey;">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                 </svg>
             </a>
             <div style="clear: both;"></div>
         </div>
         <div class="services-grid">
             <?php
                // Fetch data from accepted_services table
                $sql = "SELECT * FROM ind_subcat WHERE is_deleted = 0";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $subCategory = $stmt;
                ?>
             <?php
                if ($subCategory->rowCount() > 0) {
                    foreach ($subCategory as $row) {
                ?>
                     <div class="service-card">
                         <a href="<?php echo WEB_ROOT; ?>client/categories/index.php?view=subBooking&subcatid=<?= $row['subcatid'] ?>" target="_self" style="text-decoration: none; color: inherit;">
                             <img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" alt="Ad 1" />
                             <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 10ch;"><?= htmlspecialchars($row['sub_categor']); ?></p>
                         </a>
                     </div>
             <?php
                    }
                } else {
                    echo '<div class="list-item"><p>No records found</p></div>';
                }
                ?>
         </div>
     </section>

     <!-- Ads Section -->
     <section class="category-section">
         <h2>Featured Ads</h2>
         <div class="scroll-container ads-container">
             <div class="ad-card">
                 <img src="https://placehold.co/300x150" alt="Ad 1" />
                 <div class="ad-content">
                     <h3>Special Offer!</h3>
                     <p>Limited time discount</p>
                 </div>
             </div>
             <div class="ad-card">
                 <img src="https://placehold.co/300x150" alt="Ad 2" />
                 <div class="ad-content">
                     <h3>New Service!</h3>
                     <p>Check out our latest offering</p>
                 </div>
             </div>
             <div class="ad-card">
                 <img src="https://placehold.co/300x150" alt="Ad 3" />
                 <div class="ad-content">
                     <h3>Premium Deal</h3>
                     <p>Exclusive for members</p>
                 </div>
             </div>
         </div>
     </section>

 </div>