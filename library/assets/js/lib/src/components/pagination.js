import React from 'react';

const paginate = (currentPage, lastPage, clickEvent) => {
  const delta = 1;
  const range = [];

  for (let i = Math.max(2, (currentPage - delta)); i <= Math.min((lastPage - 1), (currentPage + delta)); i += 1) {
    range.push(i);
  }

  if ((currentPage - delta) > 2) {
    range.unshift('...');

  }

  if ((currentPage + delta) < (lastPage - 1)) {
    range.push('...');
  }

  range.unshift(1);
  
  if (lastPage !== 1) range.push(lastPage);

  return range.map((i, index) => {return (
    !isNaN(i) ?
      <li value={i} key={index} className={`page-item${currentPage == i ? ' active' : ''}`}><a data-index={i} onClick={clickEvent} className="page-link">{i}</a></li>
      : 
      <li class="page-item" key={index}>{i}</li>
  )
  });
};

const Pagination = ({ currentPage, lastPage, clickEvent }) =>{
  return(
    <div className="mt-pixabay-pagination">
        <nav aria-label="mighty-photos-pagination">
            <ul className="pagination pagination-sm">
            {paginate(currentPage, lastPage, clickEvent)}
            </ul>
        </nav>
    </div>
  )
};

export default Pagination;