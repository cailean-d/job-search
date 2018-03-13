import React = require("react");

interface Properties{

    id : number;
    name : string;
    company: string;
    schedule : string;
    demands : string;
    location : string;
    date : string;
    salaryMin : string;
    salaryMax : string
}

export const Vacancy = (props : Properties) => {
     
    return (
            
        <div className="card vacancy_block">
            <div className="card-block">
                <article className='vacancy'>
                    <header>
                        <div className="top">
                            <div className='title'>
                                <a href={'vacancy/' + props.id}>{props.name}</a>
                            </div>
                            <div className='salary'>
                                <span>
                                    {props.salaryMin}-{props.salaryMax}р.
                                </span>
                            </div>
                        </div>
                        <div className="bottom">
                            <div>
                                Компания <span className="company">"{props.company}"</span>
                            </div>
                            <div>
                                График: <span className="emp">{props.schedule.toLowerCase()}</span>
                            </div>
                        </div>
                    </header>
                    <p>
                        <span className="dem">Требования: </span>
                        {props.demands.replace(',', ', ').toLowerCase()}
                    </p>
                    <footer>
                        <div className="location">
                            <i className="fas fa-map-marker-alt"></i>
                            <div className="text">
                                {props.location}
                            </div>
                        </div>
                        <div className="date">
                            <i className="fas fa-calendar-alt"></i>
                            <div className="text">
                                {props.date}
                            </div>
                        </div>
                    </footer>
                </article>
            </div>
        </div>
        
    );
}
