(function ($) {
	var data = window.HideAdminBar;
	var form = document.querySelector(".hide-admin-bar-settings-form");

	if (!form || !data) return;

	var allField = form.querySelector(".hide-admin-bar-all");
	var roleFields = form.querySelectorAll(".hide-admin-bar-role input");
	var button = form.querySelector(".hide-admin-bar-submit");
	var notice = form.querySelector(".hide-admin-bar-notice");
	var isProcessing = false;
	var noticeTimer;

	/**
	 * "All users" checks & locks every role. Unchecking it brings back the previous selection.
	 */
	function syncRoles() {
		[].forEach.call(roleFields, function (field) {
			if (allField.checked) {
				field.setAttribute("data-was-checked", field.checked ? "1" : "");
				field.checked = true;
			} else if (field.disabled) {
				field.checked = field.getAttribute("data-was-checked") === "1";
			}

			field.disabled = allField.checked;
		});
	}

	/**
	 * Show a message next to the save button for a few seconds.
	 *
	 * @param {string} message The message.
	 * @param {boolean} success Whether it's a success message.
	 */
	function showNotice(message, success) {
		clearTimeout(noticeTimer);
		notice.textContent = message;
		notice.classList.toggle("is-success", success);
		notice.classList.toggle("is-error", !success);
		notice.classList.add("is-shown");

		noticeTimer = setTimeout(function () {
			notice.classList.remove("is-shown");
		}, 3000);
	}

	/**
	 * Save the settings.
	 *
	 * @param {Event} e The submit event.
	 */
	function onSubmit(e) {
		var roles = [];

		e.preventDefault();

		if (isProcessing) return;
		isProcessing = true;
		button.classList.add("is-loading");

		if (allField.checked) {
			roles.push("all");
		} else {
			[].forEach.call(roleFields, function (field) {
				if (field.checked) roles.push(field.value);
			});
		}

		$.ajax({
			url: window.ajaxurl,
			type: "POST",
			data: {
				action: "hide_admin_bar_save_settings",
				nonce: data.nonce,
				remove_by_roles: roles,
			},
		})
			.done(function (r) {
				var success = !!(r && r.success);

				showNotice(success ? data.i18n.saved : data.i18n.error, success);
			})
			.fail(function (jqXHR) {
				var message =
					jqXHR.responseJSON && jqXHR.responseJSON.data
						? String(jqXHR.responseJSON.data)
						: data.i18n.error;

				showNotice(message, false);
			})
			.always(function () {
				isProcessing = false;
				button.classList.remove("is-loading");
			});
	}

	allField.addEventListener("change", syncRoles);
	form.addEventListener("submit", onSubmit);
})(jQuery);
