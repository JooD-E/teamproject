// ######################## Mood Digging ############################

const moodData = {
  rainy: {
    jazz: {
      image: "img/dicovery/picker01.png",
      title: "RAINY NIGHT X JAZZ",
      song: "BLUE WINDOW"
    },
    rock: {
      image: "img/dicovery/picker02.png",
      title: "RAINY NIGHT X ROCK",
      song: "WET ASPHALT"
    },
    citypop: {
      image: "img/dicovery/picker03.png",
      title: "RAINY NIGHT X CITY POP",
      song: "NEON UMBRELLA"
    },
    funk: {
      image: "img/dicovery/picker04.png",
      title: "RAINY NIGHT X FUNK",
      song: "DRIZZLE GROOVE"
    }
  },

  drive: {
    jazz: {
      image: "img/dicovery/picker05.png",
      title: "SEOUL DRIVE X JAZZ",
      song: "MIDNIGHT TAXI"
    },
    rock: {
      image: "img/dicovery/picker06.png",
      title: "SEOUL DRIVE X ROCK",
      song: "CITY ENGINE"
    },
    citypop: {
      image: "img/dicovery/picker07.png",
      title: "SEOUL DRIVE X CITY POP",
      song: "MUTT"
    },
    funk: {
      image: "img/dicovery/picker08.png",
      title: "SEOUL DRIVE X FUNK",
      song: "HAN RIVER BASS"
    }
  },

  summer: {
    jazz: {
      image: "img/dicovery/picker09.png",
      title: "SUMMER MOOD X JAZZ",
      song: "SUNSET NOTE"
    },
    rock: {
      image: "img/dicovery/picker10.png",
      title: "SUMMER MOOD X ROCK",
      song: "HOT TRACK"
    },
    citypop: {
      image: "img/dicovery/picker11.png",
      title: "SUMMER MOOD X CITY POP",
      song: "GOLDEN HOUR"
    },
    funk: {
      image: "img/dicovery/picker12.png",
      title: "SUMMER MOOD X FUNK",
      song: "POOL SIDE"
    }
  },

  sunday: {
    jazz: {
      image: "img/dicovery/picker13.png",
      title: "SUNDAY MORNING X JAZZ",
      song: "SOFT EGGS"
    },
    rock: {
      image: "img/dicovery/picker14.png",
      title: "SUNDAY MORNING X ROCK",
      song: "SLOW RADIO"
    },
    citypop: {
      image: "img/dicovery/picker15.png",
      title: "SUNDAY MORNING X CITY POP",
      song: "LAZY STREET"
    },
    funk: {
      image: "img/dicovery/picker16.png",
      title: "SUNDAY MORNING X FUNK",
      song: "BRUNCH BEAT"
    }
  },

  coffee: {
    jazz: {
      image: "img/dicovery/picker17.png",
      title: "LATE COFFEE X JAZZ",
      song: "AFTER HOURS"
    },
    rock: {
      image: "img/dicovery/picker18.png",
      title: "LATE COFFEE X ROCK",
      song: "CAFFEINE"
    },
    citypop: {
      image: "img/dicovery/picker19.png",
      title: "LATE COFFEE X CITY POP",
      song: "NIGHT BLEND"
    },
    funk: {
      image: "img/dicovery/picker20.png",
      title: "LATE COFFEE X FUNK",
      song: "ESPRESSO LINE"
    }
  }
};

const albumImg = document.querySelector(".album_represent img");
const albumTitle = document.querySelector(".album_info h3");
const playBtn = document.querySelector(".album_title .play");
const playBtnImg = document.querySelector(".album_title .play img");
const timeText = document.querySelector(".album_title .time");
const progress = document.querySelector(".music_bar .progress");

const genreLabels = document.querySelectorAll(".genre span[data-genre]");
const pickerBtns = document.querySelectorAll(".mood button");

let previewTimer = null;
let currentTime = 0;
const totalTime = 60;
let isPlaying = false;

function formatTime(sec) {
  return `0:${String(sec).padStart(2, "0")}`;
}

function updatePreviewBar() {
  const percent = (currentTime / totalTime) * 100;

  progress.style.width = `${percent}%`;
  timeText.textContent = `${formatTime(currentTime)} / 1:00`;
}

function updatePlayIcon() {
  if (isPlaying) {
    playBtnImg.src = "img/dicovery/icon_pause.png";
    playBtnImg.alt = "일시정지아이콘";
  } else {
    playBtnImg.src = "img/dicovery/icon_play.png";
    playBtnImg.alt = "재생아이콘";
  }
}

function startPreview() {
  if (isPlaying) return;

  isPlaying = true;
  updatePlayIcon();

  previewTimer = setInterval(() => {
    currentTime++;

    if (currentTime >= totalTime) {
      currentTime = totalTime;
      updatePreviewBar();
      pausePreview();
      return;
    }

    updatePreviewBar();
  }, 1000);
}

function pausePreview() {
  clearInterval(previewTimer);
  previewTimer = null;
  isPlaying = false;
  updatePlayIcon();
}

function resetPreview() {
  pausePreview();
  currentTime = 0;
  updatePreviewBar();
  updatePlayIcon();
}

function changeAlbum(mood, genre) {
  const selectedAlbum = moodData[mood][genre];

  albumImg.src = selectedAlbum.image;
  albumImg.alt = selectedAlbum.title;
  albumTitle.textContent = selectedAlbum.title;

  playBtn.innerHTML = "";
  playBtn.appendChild(playBtnImg);
  playBtn.append(selectedAlbum.song);

  resetPreview();
}

function changeActiveGenre(genre) {
  genreLabels.forEach((label) => {
    label.classList.toggle("active", label.dataset.genre === genre);
  });
}

function changeActivePicker(selectedBtn) {
  pickerBtns.forEach((btn) => {
    btn.classList.remove("active");

    const img = btn.querySelector("img");
    if (img) img.src = "img/dicovery/button_default.png";
  });

  selectedBtn.classList.add("active");

  const selectedImg = selectedBtn.querySelector("img");
  if (selectedImg) selectedImg.src = "img/dicovery/button_active.png";
}

pickerBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const mood = btn.dataset.mood;
    const genre = btn.dataset.genre;

    changeAlbum(mood, genre);
    changeActiveGenre(genre);
    changeActivePicker(btn);
  });
});

playBtn.addEventListener("click", () => {
  if (isPlaying) {
    pausePreview();
  } else {
    startPreview();
  }
});

updatePreviewBar();
updatePlayIcon();






// ######################## You Might Also Like Slider ############################

const mightList = document.querySelector(".might_list");
const prevArrow = document.querySelector(".arrow img:first-child");
const nextArrow = document.querySelector(".arrow img:last-child");

if (mightList && prevArrow && nextArrow) {
  function getSlideAmount() {
    const firstItem = mightList.querySelector("li");
    if (!firstItem) return 0;

    const itemWidth = firstItem.offsetWidth;
    const gap = parseInt(getComputedStyle(mightList).gap) || 0;

    return itemWidth + gap;
  }

  function updateArrowState() {
    const maxScrollLeft = mightList.scrollWidth - mightList.clientWidth;

    prevArrow.classList.toggle("disabled", mightList.scrollLeft <= 0);
    nextArrow.classList.toggle("disabled", mightList.scrollLeft >= maxScrollLeft - 2);
  }

  prevArrow.addEventListener("click", () => {
    mightList.scrollBy({
      left: -getSlideAmount(),
      behavior: "smooth"
    });
  });

  nextArrow.addEventListener("click", () => {
    mightList.scrollBy({
      left: getSlideAmount(),
      behavior: "smooth"
    });
  });

  let isDragging = false;
  let startX = 0;
  let startScrollLeft = 0;

  mightList.addEventListener("mousedown", (e) => {
    isDragging = true;
    mightList.classList.add("dragging");

    startX = e.pageX;
    startScrollLeft = mightList.scrollLeft;
  });

  mightList.addEventListener("mousemove", (e) => {
    if (!isDragging) return;

    e.preventDefault();

    const moveX = e.pageX - startX;
    mightList.scrollLeft = startScrollLeft - moveX;
  });

  mightList.addEventListener("mouseup", () => {
    isDragging = false;
    mightList.classList.remove("dragging");
  });

  mightList.addEventListener("mouseleave", () => {
    isDragging = false;
    mightList.classList.remove("dragging");
  });

  mightList.addEventListener("scroll", updateArrowState);
  window.addEventListener("resize", updateArrowState);
  window.addEventListener("load", updateArrowState);

  updateArrowState();
}


// ######################## Soundtrack Scroll ############################

document.addEventListener("DOMContentLoaded", () => {
  const soundtrack = document.querySelector(".soundtrack");

  if (!soundtrack) return;

  const timeBlocks = soundtrack.querySelectorAll(".time_block");
  const contents = soundtrack.querySelectorAll(".left_box .content");

  function changeSoundtrackContent() {
    const windowMiddle = window.innerHeight / 2;

    timeBlocks.forEach((block) => {
      const blockTop = block.getBoundingClientRect().top;
      const blockBottom = block.getBoundingClientRect().bottom;
      const targetTime = block.dataset.target;

      if (blockTop <= windowMiddle && blockBottom >= windowMiddle) {
        contents.forEach((content) => {
          content.classList.toggle("active", content.dataset.time === targetTime);
        });
      }
    });
  }

  window.addEventListener("scroll", changeSoundtrackContent);
  window.addEventListener("resize", changeSoundtrackContent);

  changeSoundtrackContent();
});