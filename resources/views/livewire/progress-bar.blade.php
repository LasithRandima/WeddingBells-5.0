

<div>

    <style>
        .progress {
          height: 20vh;
          display: flex;
          flex-direction: column;
          gap: 0.2rem;
          align-items: center;
          justify-content: center;
        }
        .progress_item {
          padding: 0.5rem 0;
        }
        .progress_title {
          color: #333;
          font-size: 1.6rem;
          padding-bottom: 2.6rem;
        }
        .progress_barr {
    position: relative;
    width: 30rem;
    height: 8px;
    border-radius: 2rem;
    background: #9370DB; /* Royal Purple */
}

        @media (max-width: 768px) {
          .progress_barr {
            width: 25rem;
          }
        }
        @media (max-width: 440px) {
          .progress_barr {
            width: 300px;
          }
        }
        @media (max-width: 340px) {
          .progress_barr {
            width: 280px;
          }
        }
        .barr {
    border-radius: inherit;
    background: linear-gradient(90deg, #9370DB, #FFD700, #9370DB);
    position: absolute;
    transition: width 1.5s cubic-bezier(0.1, 0.42, 0.85, 1);
    width: 0;
    height: 100%;
    left: 0;
}

        .barr::after {
    content: '{{$allTasks>1 ? ceil(($completedTasks/$allTasks)*100) : 0  }}%';
    position: absolute;
    right: 0;
    top: -3rem;
    width: 4rem;
    height: 2rem;
    background: #9370DB; /* Royal Purple */
    font-size: 18px;
    line-height: 2rem;
    color: #FFD700; /* Champagne Gold */
    text-align: center;
    border-radius: 0.1rem;
    animation: text 0.6s ease-in-out;
    font-weight: bold;
}

.barr::before {
    content: ' ';
    position: absolute;
    right: 1rem;
    top: -1.2rem;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-top: 10px solid #9370DB; /* Royal Purple */
    animation: text 0.6s ease-in-out;
}

        @keyframes text {
          0% {
            opacity: 0;
          }
          50% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }


            </style>

    <div>
        <div class="body">
            <div class="row mb-3">
                <div class="col-md-12 mt-3 text-center">
                    <div class="progress_container">
                        <div class="progress">
                            <div class="progress_item">
                                <h3 class="progress_title">You Have Completed {{ $completedTasks  }} out of {{ $allTasks }} Tasks</h3>
                                <div class="progress_barr">
                                    <div class="barr" data-value="{{$allTasks >= 1 ? ceil(($completedTasks/$allTasks)*100) : 0  }}" data-title="{{ $allTasks }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





    <script>
         document.addEventListener('livewire:init', function () {
            setTimeout(() =>{
                document.querySelector('.body').classList.add('display');
            }, 1000);

            let bars = document.querySelectorAll('.barr');
            bars.forEach((progress) => {
            // let value = progress.getAttribute('data-value');
            let value = {{$allTasks >= 1 ? ceil(($completedTasks/$allTasks)*100) : 0  }};
            progress.style.width = `${ {{$allTasks >= 1 ? ceil(($completedTasks/$allTasks)*100) : 0  }} }%`;
            // let count = 0;
            // let progressAnimation = setInterval(() => {
            //     count++;
            //     progress.setAttribute('data-text', `${count}%`);
            //     if (count >= {{$allTasks >= 1 ? ceil(($completedTasks/$allTasks)*100) : 0  }}) {
            //     clearInterval(progressAnimation);
            //     }
            // }, 15);
            });
        });

    </script>

</div>
