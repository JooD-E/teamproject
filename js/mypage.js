document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("followSidebar");

    if (sidebar) {
        const parent = sidebar.parentElement;
        
        const initialTop = 250;
        const topMargin = 40

        window.addEventListener("scroll", function() {
            const parentRect = parent.getBoundingClientRect();
            
            if (parentRect.top < topMargin - initialTop) {
                
                let moveAmount = topMargin - parentRect.top - initialTop;

                const maxMove = parent.offsetHeight - sidebar.offsetHeight - initialTop;
                
                if (moveAmount > maxMove) {
                    moveAmount = maxMove;
                }

                sidebar.style.transform = `translateY(${moveAmount}px)`;

            } else {
                sidebar.style.transform = `translateY(0px)`;
            }
        });
    }
});