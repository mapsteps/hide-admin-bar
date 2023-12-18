(function ($) {
	var doingAjax = false;
	var saveButton;
	var nonceField;
	var savedStatusBar;
	var settingFields;
	var $removeAdminBar;
	var adminBarRemovalRoles = [];

	/**
	 * Call the main functions here.
	 */
	function init() {
		saveButton = document.querySelector("button.save-general-settings");
		nonceField = document.querySelector('[name="hide_admin_bar_settings_nonce"]');

		savedStatusBar = document.querySelector(
			".hide-admin-bar-settings-form .saved-status-bar"
		);

		settingFields = document.querySelectorAll(
			".hide-admin-bar-settings-form .general-setting-field"
		);

		saveButton.addEventListener("click", function (e) {
			e.preventDefault();
			saveSettings();
		});

		setupAdminBarRemovalRoles();
	}

	function startLoading() {
		saveButton.classList.add('is-loading');
	};

	function stopLoading() {
		saveButton.classList.remove('is-loading');
	};

	/**
	 * Send ajax request to save the settings.
	 */
	function saveSettings() {
		if (doingAjax) return;
		doingAjax = true;
		startLoading();

		var data = {};

		data.action = "hide_admin_bar_save_settings";
		data.nonce = nonceField ? nonceField.value : "";

		[].slice.call(settingFields).forEach(function (field) {
			if (field.type === "checkbox") {
				data[field.name] = field.checked ? 1 : 0;
			} else if (field.tagName.toLowerCase() === "select") {
				if (field.name === "remove_by_roles[]") {
					data[field.name] = adminBarRemovalRoles;
				}
			} else {
				data[field.name] = field.value;
			}
		});

		$.ajax({
			url: ajaxurl,
			type: "post",
			dataType: "json",
			data: data,
		})
			.done(function (r) {
				switchSavedStatus("show");

				// We need some delay to give visual effect.
				setTimeout(function () {
					switchSavedStatus("hide");
				}, 2500);
			})
			.always(function () {
				stopLoading();
				doingAjax = false;
			});
	};

	/**
	 * Switch saved status in the metabox headers.
	 *
	 * @param {string} state Whether or not to show the "Saved" status.
	 *                       Accepted values: "show" or "hide". Default is "show".
	 */
	function switchSavedStatus(state) {
		if (state === "hide") {
			savedStatusBar.classList.remove("is-shown");
		} else {
			savedStatusBar.classList.add("is-shown");
		}
	}

	function setupAdminBarRemovalRoles() {
		$removeAdminBar = $(".hide-admin-bar-settings .remove-admin-bar");

		$removeAdminBar.select2();

		setAdminBarRemovalRoles($removeAdminBar.select2("data"));

		$removeAdminBar.on("select2:select", function (e) {
			var roleObjects = $removeAdminBar.select2("data");
			var newSelections = [];

			if (e.params.data.id === "all") {
				$removeAdminBar.val("all");
				$removeAdminBar.trigger("change");
			} else {
				if (roleObjects.length) {
					roleObjects.forEach(function (role) {
						if (role.id !== "all") {
							newSelections.push(role.id);
						}
					});

					$removeAdminBar.val(newSelections);
					$removeAdminBar.trigger("change");
				}
			}

			// Use the modified list.
			setAdminBarRemovalRoles($removeAdminBar.select2("data"));
		});

		$removeAdminBar.on("select2:unselect", function (e) {
			setAdminBarRemovalRoles($removeAdminBar.select2("data"));
		});
	}

	function setAdminBarRemovalRoles(roleObjects) {
		adminBarRemovalRoles = [];

		if (!roleObjects || !roleObjects.length) {
			return;
		}

		roleObjects.forEach(function (role) {
			adminBarRemovalRoles.push(role.id);
		});
	}

	init();
})(jQuery);
