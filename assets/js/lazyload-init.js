function logElementEvent(eventName, element) {
	console.log(
	  Date.now(),
	  eventName,
	  element.getAttribute("data-bg88da112-bg-hidpi=bg")
	);
}

var callback_enter = function (element) {
	logElementEvent("🔑 ENTERED", element);
};
var callback_exit = function (element) {
	logElementEvent("🚪 EXITED", element);
};
var callback_loading = function (element) {
	logElementEvent("⌚ LOADING", element);
};
var callback_loaded = function (element) {
	logElementEvent("👍 LOADED", element);
};
var callback_error = function (element) {
	logElementEvent("💀 ERROR", element);
	element.src =
	  "https://via.placeholder.com/220x280/?text=Error+Placeholder";
};
var callback_finish = function () {
	logElementEvent("✔️ FINISHED", document.documentElement);
};
var callback_cancel = function (element) {
	logElementEvent("🔥 CANCEL", element);
};

LL = new LazyLoad({
	// Assign the callbacks defined above
	callback_enter: callback_enter,
	callback_exit: callback_exit,
	callback_cancel: callback_cancel,
	callback_loading: callback_loading,
	callback_loaded: callback_loaded,
	callback_error: callback_error,
	callback_finish: callback_finish
});
/* document.addEventListener("DOMContentLoaded", function() {
    var lazyImages = [].slice.call(document.querySelectorAll("img.lazyload"));
    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.srcset = lazyImage.dataset.srcset;
                    lazyImage.classList.remove("lazyload");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });
        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    } else {
        // Fallback for older browsers
        lazyImages.forEach(function(lazyImage) {
            lazyImage.src = lazyImage.dataset.src;
            lazyImage.srcset = lazyImage.dataset.srcset;
            lazyImage.classList.remove("lazyload");
        });
    }
});
 */
 /* var lazyLoadInstance = new LazyLoad({
  elements_selector: ".lazyload", // Thẻ img có class="lazyload" sẽ được lazyload
  threshold: 0, // Khoảng cách từ khung nhìn của người dùng đến phần tử cần lazyload để bắt đầu tải ảnh.
  callback_enter: function(element) { console.log("Element entered lazyload zone: ", element); }, // Hàm callback được gọi khi phần tử được lazyload
  callback_loaded: function(element) { console.log("Element loaded: ", element); }, // Hàm callback được gọi khi phần tử đã được tải
  callback_error: function(element) { console.log("Element failed to load: ", element); }, // Hàm callback được gọi khi phần tử không thể tải
  callback_finish: function() { console.log("All elements have been loaded"); } // Hàm callback được gọi khi tất cả phần tử đã được tải
}); */
